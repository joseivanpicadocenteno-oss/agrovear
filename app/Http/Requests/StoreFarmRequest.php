<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFarmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Convierte el checkbox desmarcado (null) en false/0 explícito para la regla boolean
        $this->merge([
            'active' => $this->has('active') ? 1 : 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|min:8|max:20',
            'description' => 'nullable|string|max:400',
            'active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de su finca es requerido.',
            'name.string' => 'El nombre de la finca solo puede contener texto.',
            'name.max' => 'El nombre de la finca no puede tener más de 255 caracteres.',

            'department.required' => 'El departamento de la finca es requerido.',
            'department.string' => 'El departamento solo puede contener texto.',
            'department.max' => 'El departamento no puede tener más de 255 caracteres.',

            'municipality.required' => 'El municipio de la finca es requerido.',
            'municipality.string' => 'El municipio solo puede contener texto.',
            'municipality.max' => 'El municipio no puede tener más de 255 caracteres.',

            'phone.required' => 'El número de teléfono de la finca o agricultor es requerido.',
            'phone.string' => 'El número solo puede contener texto o números.',
            'phone.min' => 'El número no puede tener menos de 8 dígitos.',
            'phone.max' => 'El número no puede tener más de 20 dígitos.',
        ];
    }
}