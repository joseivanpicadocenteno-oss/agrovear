<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:255',
            'type' => 'required|string|max:255',
            'unit_measurement' => 'required|integer',
            'current_stock' => 'required|integer',
            'min_stock' => 'required|numeric',
            'unit_cost' => 'required|numeric',
            'historical_average_price' => 'required|numeric',
            'last_purchase_date' => 'required|date',
            'regular_supplier' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'farm_id' => 'required|exists:farms,id'
        ];
    }

    public function messages()
    {
    
    return [
        'name.required' => 'Se requiere el nombre del producto.',
        'name.string' => 'El nombre del producto solo puede contener letras.',
        'name.max' => 'El nombre del producto no puede tener más de 255 caracteres.',

        'type.required' => 'Se requiere el tipo de producto.',
        'type.string' => 'El tipo de producto solo puede contener letras.',
        'type.max' => 'El tipo de producto no puede tener más de 255 caracteres.',

        'unit_measurement.required' => 'Se requiere la unidad de medida.',
        'unit_measurement.integer' => 'La unidad de medida debe ser un número entero.',

        'current_stock.required' => 'Se requiere el stock actual.',
        'current_stock.integer' => 'El stock actual debe ser un número entero.',

        'min_stock.required' => 'Se requiere el stock mínimo.',
        'min_stock.numeric' => 'El stock mínimo debe ser un valor numérico.',

        'unit_cost.required' => 'Se requiere el costo por unidad.',
        'unit_cost.numeric' => 'El costo por unidad debe ser un valor numérico.',

        'historical_average_price.required' => 'Se requiere el precio promedio histórico.',
        'historical_average_price.numeric' => 'El precio promedio histórico debe ser un valor numérico.',

        'last_purchase_date.required' => 'Se requiere la fecha de la última compra.',
        'last_purchase_date.date' => 'La fecha de la última compra no es válida.',

        'regular_supplier.required' => 'Se requiere el proveedor habitual.',
        'regular_supplier.string' => 'El proveedor habitual solo puede contener letras.',
        'regular_supplier.max' => 'El proveedor habitual no puede tener más de 255 caracteres.',

        'batch.required' => 'Se requiere el lote del producto.',
        'batch.string' => 'El lote debe ser un texto.',
        'batch.max' => 'El lote no puede tener más de 255 caracteres.',

        'expiration_date.required' => 'Se requiere la fecha de vencimiento.',
        'expiration_date.date' => 'La fecha de vencimiento no es válida.',

        'farms_id.required' => 'La identifiacion de granja es requerida.',
        'farms_id.exists' => 'La granja seleccionada aun no es creada oh no existe.'
        ];
    }
}
