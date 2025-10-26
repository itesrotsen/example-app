<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProyectoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'string|nullable',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'date|nullable|after_or_equal:fecha_inicio',
            'presupuesto' => 'numeric|nullable|min:0',
        ];
    }
}
