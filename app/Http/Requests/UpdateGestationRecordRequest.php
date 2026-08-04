<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGestationRecordRequest extends FormRequest
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
        'service_date' => 'sometimmes|date',
        'estimated_birth_date' => 'sometimmes|date',
        'actual_birth_date' => 'sometimmes|date',
        'live_births' => 'sometimmes|numeric',
        'stillbirths' => 'sometimmes|numeric',
        'observations' => 'sometimes|string|max:255',
        'active' => 'sometimes|boolean',
        'animal_id' => 'sometimes|exists:animals,id',
        ];
    }
}
