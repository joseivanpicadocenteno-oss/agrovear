<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFarmRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
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
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El nombre de su granja es requerido.',
            'name.string' => 'El nombre de la granja solo puede contener texto.',
            'name.max' => 'El nombre de la granja no puede tener más de 255 caracteres.',

            'department.required' => 'El departamento de la granja es requerido.',
            'department.string' => 'El departamento solo puede contener texto.',
            'department.max' => 'El departamento no puede tener más de 255 caracteres.',

            'municipality.required' => 'El municipio de la granja es requerido.',
            'municipality.string' => 'El municipio solo puede contener texto.',
            'municipality.max' => 'El municipio no puede tener más de 255 caracteres.',

            'phone.required' => 'El numero de telefono de la granja o agricultor es requerido.',
            'phone.string' => 'El numero solo puede contener numeros',
            'phone.min' => 'El numero no puede tener más de 20 digitos.',
            'phone.max' => 'El numero no puede tener menos de 08 digitos.',

        ];
    }
}
