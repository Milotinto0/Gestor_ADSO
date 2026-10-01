@extends('layouts.app')
@section('title','Editar Aprendiz')

@section('content')
<div class="contenedor">
    <h1>Editar Aprendiz</h1>

    {{-- Bloque de errores de validación --}}
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

    <form action="{{ route('aprendices.update', $aprendiz) }}" method="POST" class="formulario">
        @csrf
        @method('PUT')

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $aprendiz->nombre) }}"
                required>
            @error('nombre')
            <span class="error-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo">
            <label for="documento">Documento</label>
            <input type="text"
                id="documento"
                name="documento"
                value="{{ old('documento', $aprendiz->documento) }}"
                required>
            @error('documento')
            <span class="error-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo">
            <label for="correo">Correo</label>
            <input type="email"
                id="correo"
                name="correo"
                value="{{ old('correo', $aprendiz->correo) }}"
                required>
            @error('correo')
            <span class="error-campo">{{ $message }}</span>
            @enderror
        </div>
        <div class="campo">
            <label for="ficha">Ficha</label>
            <input type="number"
                id="ficha_id"
                name="ficha_id"
                value="{{ old('ficha_id', $aprendiz->ficha_id) }}"
                required>
            @error('ficha')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="{{ route('aprendices.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection