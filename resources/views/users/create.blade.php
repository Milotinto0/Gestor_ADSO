@extends('layouts.app')
@section('title','Nuevo Usuario')

@section('content')
<div class="contenedor">
    <h1>Nuevo Usuario</h1>

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

    <form action="{{ route('users.store') }}" method="POST" class="formulario">
        @csrf

        <div class="campo">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="role">Rol</label>
            <select id="role" name="role" required>
                <option value="">Selecciona un rol</option>
                <option value="administrador" @selected(old('role') === 'administrador')>Administrador</option>
                <option value="instructor" @selected(old('role') === 'instructor')>Instructor</option>
                <option value="aprendiz" @selected(old('role') === 'aprendiz')>Aprendiz</option>
            </select>
            @error('role')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            @error('password')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Guardar</button>
            <a href="{{ route('users.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection