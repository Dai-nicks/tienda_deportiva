<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProducto extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'nombre_producto' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:100',
            'descripcion' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:450',
            'precio' => ($isUpdate ? 'sometimes' : 'required').'|numeric|min:1',
            'stock' => ($isUpdate ? 'sometimes' : 'required').'|integer|max:100',
            'talla' => ($isUpdate ? 'sometimes' : 'required').'|string|max:1',
            'color' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:30',
            'imagen_url' => ($isUpdate ? 'sometimes' : 'required').'|string|max:300',
            'estado' => ($isUpdate ? 'sometimes' : 'required').'|boolean',
            'id_categoria' => ($isUpdate ? 'sometimes' : 'required').'|integer|exists:tblCategorias,id_categoria',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_producto.required' => 'El nombre del producto es obligatorio.',
            'nombre_producto.string' => 'El nombre del producto debe ser un texto.',
            'nombre_producto.min' => 'El nombre del producto debe tener al menos 1 caracter.',
            'nombre_producto.max' => 'El nombre del producto no debe exceder los 100 caracteres.',

            
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.min' => 'La descripción debe tener al menos 1 caracter.',
            'descripcion.max' => 'La descripción no debe exceder los 450 caracteres.',

            
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio debe ser mínimo 1.',

            
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.max' => 'El stock no debe ser mayor a 100 unidades.',

            
            'talla.required' => 'La talla es obligatoria.',
            'talla.string' => 'La talla debe ser un texto.',
            'talla.max' => 'La talla debe tener máximo 1 caracter.',

            
            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser un texto.',
            'color.min' => 'El color debe tener al menos 1 caracter.',
            'color.max' => 'El color no debe exceder los 30 caracteres.',

            
            'imagen_url.required' => 'La URL de la imagen es obligatoria.',
            'imagen_url.string' => 'La URL de la imagen debe ser un texto.',
            'imagen_url.max' => 'La URL de la imagen no debe exceder los 300 caracteres.',

            
            'estado.required' => 'El estado del producto es obligatorio.',
            'estado.boolean' => 'El estado debe ser verdadero o falso.',

            
            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_categoria.integer' => 'La categoría debe ser un número entero.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',
        ];
    }
}
