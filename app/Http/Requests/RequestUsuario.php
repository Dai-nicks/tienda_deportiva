<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUsuario extends FormRequest
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
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

       return [
            'nombre' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:100',
            'apellido' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:100',
            'documento' => ($isUpdate ? 'sometimes' : 'required').'|string|min:1|max:50|unique:tblUsuarios,documento',
            'correo' => ($isUpdate ? 'sometimes' : 'required').'|email|max:150|unique:tblUsuarios,correo',
            'contrasena' => ($isUpdate ? 'nullable' : 'required').'|string|min:6',
            'telefono' => ($isUpdate ? 'sometimes' : 'nullable').'|string|max:20',
            'direccion' => ($isUpdate ? 'sometimes' : 'nullable').'|string|max:255',
            'rol' => ($isUpdate ? 'sometimes' : 'required').'|string|max:50',
            'estado' => ($isUpdate ? 'sometimes' : 'nullable').'|boolean',
            'fecha_nacimiento' => ($isUpdate ? 'sometimes' : 'required').'|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder los 100 caracteres.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no debe exceder los 100 caracteres.',

            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'Este documento ya está registrado.',
            'documento.max' => 'El documento no debe exceder los 50 caracteres.',

            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Debe ser un correo válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'correo.max' => 'El correo no debe exceder los 150 caracteres.',

            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',

            'telefono.max' => 'El teléfono no debe exceder los 20 caracteres.',

            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',

            'rol.required' => 'El rol es obligatorio.',
            'rol.max' => 'El rol no debe exceder los 50 caracteres.',

            'estado.boolean' => 'El estado debe ser verdadero o falso.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'Debe ser una fecha válida.',
        ];
    }
}
