<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Obtener las alertas del usuario autenticado.
     */
    public function index(Request $request): JsonResponse
    {
        $alerts = Alert::with('animal')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Alertas obtenidas correctamente.',
            'alerts' => $alerts,
        ]);
    }

    /**
     * Crear una nueva alerta.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'severity' => 'required|string|in:info,warning,danger,success',
            'read_at' => 'nullable|date',
        ]);

        $validated['user_id'] = $request->user()->id;

        $alert = Alert::create($validated);

        return response()->json([
            'message' => 'Alerta creada correctamente.',
            'alert' => $alert->load('animal'),
        ], 201);
    }

    /**
     * Mostrar una alerta específica.
     */
    public function show(Request $request, Alert $alert): JsonResponse
    {
        if ($alert->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permiso para consultar esta alerta.',
            ], 403);
        }

        return response()->json([
            'message' => 'Alerta obtenida correctamente.',
            'alert' => $alert->load('animal'),
        ]);
    }

    /**
     * Marcar una alerta como leída.
     */
    public function markAsRead(Request $request, Alert $alert): JsonResponse
    {
        if ($alert->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permiso para modificar esta alerta.',
            ], 403);
        }

        $alert->update([
            'read_at' => now(),
        ]);

        return response()->json([
            'message' => 'Alerta marcada como leída.',
            'alert' => $alert->fresh()->load('animal'),
        ]);
    }

    /**
     * Eliminar una alerta.
     */
    public function destroy(Request $request, Alert $alert): JsonResponse
    {
        if ($alert->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar esta alerta.',
            ], 403);
        }

        $alert->delete();

        return response()->json([
            'message' => 'Alerta eliminada correctamente.',
        ]);
    }
}
