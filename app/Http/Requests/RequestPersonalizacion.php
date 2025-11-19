<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPersonalizacion extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'id_producto' => ($isUpdate ? 'sometimes' : 'required').'|exists:tblProductos,id_producto',
            'id_usuario' => ($isUpdate ? 'sometimes' : 'required').'|exists:tblUsuarios,id_usuario',

            'tipo_perzonalizacion' => ($isUpdate ? 'sometimes' : 'required').'|string|max:100',
            'talla' => ($isUpdate ? 'sometimes' : 'required').'|string|max:1',

            'precio_total_personalizacion' => ($isUpdate ? 'sometimes' : 'required').'|numeric|min:1',

            'diseño' => 'nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'id_producto.required' => 'El producto es obligatorio.',
            'id_producto.exists' => 'El producto seleccionado no es válido.',

            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.exists' => 'El usuario seleccionado no es válido.',

            'tipo_perzonalizacion.required' => 'El tipo de personalización es obligatorio.',
            'tipo_perzonalizacion.string' => 'El tipo de personalización debe ser una cadena de texto.',
            'tipo_perzonalizacion.max' => 'El tipo de personalización no puede exceder los :max caracteres.',

            'talla.required' => 'La talla es obligatoria.',
            'talla.string' => 'La talla debe ser texto.',
            'talla.max' => 'La talla no puede exceder los :max caracteres.',

            'precio_total_personalizacion.required' => 'El precio total es obligatorio.',
            'precio_total_personalizacion.numeric' => 'El precio total debe ser numérico.',
            'precio_total_personalizacion.min' => 'El precio total debe ser al menos :min.',
        ];
    }
}
