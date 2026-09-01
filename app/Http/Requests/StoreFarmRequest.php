<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
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
}
