<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends FormRequest
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
        $categoriaId = $this->route('categoria')->id;

        return [
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categorias', 'nombre')->ignore($categoriaId)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:120',
                Rule::unique('categorias', 'slug')->ignore($categoriaId)
            ],
            'descripcion' => 'nullable|string|max:500',
            'icono' => 'nullable|string|max:50',
            'color' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'orden' => 'nullable|integer|min:0',
            'categoria_padre_id' => [
                'nullable',
                'exists:categorias,id',
                Rule::notIn([$categoriaId]) // No puede ser su propia categoría padre
            ],
            'activo' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'nombre.unique' => 'Ya existe una categoría con ese nombre.',
            'slug.unique' => 'Ya existe una categoría con ese slug.',
            'color.regex' => 'El color debe estar en formato hexadecimal (#000000).',
            'categoria_padre_id.exists' => 'La categoría padre seleccionada no existe.',
            'categoria_padre_id.not_in' => 'Una categoría no puede ser su propia categoría padre.',
            'orden.min' => 'El orden debe ser un número positivo.',
        ];
    }
}
