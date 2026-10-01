<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $usuario = $this->route('usuario');
        $usuarioId = $usuario instanceof \App\Models\User ? $usuario->id : null;
        $esCreacion = $this->isMethod('POST');

        return [
            'name'     => ['required', 'string', 'max:120'],
            'email'    => [
                'required',
                'email',
                'max:120',
                Rule::unique('users', 'email')->ignore($usuarioId),
            ],
            'role'     => ['required', Rule::in(['administrador', 'instructor', 'aprendiz'])],
            'password' => $esCreacion
                ? ['required', 'confirmed', Password::min(8)]
                : ['nullable', 'confirmed', Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'El nombre es obligatorio.',
            'name.max'           => 'El nombre no puede superar los 120 caracteres.',
            'email.required'     => 'El correo es obligatorio.',
            'email.email'        => 'El correo debe tener un formato válido.',
            'email.unique'       => 'Ya existe un usuario con ese correo.',
            'role.required'      => 'El rol es obligatorio.',
            'role.in'            => 'El rol seleccionado no es válido.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}