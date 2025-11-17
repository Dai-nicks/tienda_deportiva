<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategoria extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);
        return [
            'nombre_categoria' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:80',
            'descripcion' => ($isUpdate ? 'sometimes' : 'nullable').'|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_categoria.required' => 'El nombre de la categoría es obligatorio.',
            'nombre_categoria.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'nombre_categoria.min' => 'El nombre de la categoría debe tener al menos 1 carácter.',
            'nombre_categoria.max' => 'El nombre de la categoría no debe exceder los 80 caracteres.',

            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
