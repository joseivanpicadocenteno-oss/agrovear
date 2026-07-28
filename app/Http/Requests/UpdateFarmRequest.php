<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmRequest extends FormRequest
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
}
