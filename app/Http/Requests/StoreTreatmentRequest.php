<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * //@return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|datetime',
            'end_date' => 'required|datetime',
            'diagnosis' => 'required|string|max:500',
            'observations' => 'nullable|string|max:255',
            'active' => 'boolean',
            'animal_id' => 'required|exists:animals,id'
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'La fecha de inicio es requerida',
            'start_date.datetime' => 'La fecha de inicio es campo numerico',

            'end_date.required' => 'La fecha de finalizacion es requerida.',
            'end_date.datetime' => 'La fecha de finalizacion es requerida.',

            'diagnosis.required' => 'Breve diagnosis requerida.',
            'diagnosis.string' => 'La Diagnosis solo puede contener letras',
            'diagnosis.max' => 'El Maximo de Caracteres en diagnosis es de 500',

            'animal_id.required' => 'La identificacion del animal es requerida',
            'animal_id.exists' => 'El animal seleccionado aun no es creado.'
        ];
    }
}
