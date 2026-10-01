@extends('layouts.app')
@section('title','Editar Usuario')

@section('content')
<div class="contenedor">
    <h1>Editar Usuario</h1>

    @if ($errors->any())
    <div class="alerta-errores">
        <strong>Por favor corrige los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('users.update', $usuario) }}" method="POST" class="formulario">
        @csrf
        @method('PUT')

        <div class="campo">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name"
                value="{{ old('name', $usuario->name) }}" required>
            @error('name')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email"
                value="{{ old('email', $usuario->email) }}" required>
            @error('email')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="role">Rol</label>
            <select id="role" name="role" required>
                <option value="administrador" @selected(old('role', $usuario->role) === 'administrador')>Administrador</option>
                <option value="instructor" @selected(old('role', $usuario->role) === 'instructor')>Instructor</option>
                <option value="aprendiz" @selected(old('role', $usuario->role) === 'aprendiz')>Aprendiz</option>
            </select>
            @error('role')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="password">Nueva contraseña <small>(dejar vacío para no cambiarla)</small></label>
            <input type="password" id="password" name="password">
            @error('password')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="password_confirmation">Confirmar nueva contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('users.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection