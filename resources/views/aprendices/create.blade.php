@extends('layouts.app')
@section('title','Nuevo Aprendiz')


@section('content')
<div class="contenedor">
    <h1>Nuevo Aprendiz</h1>

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

    <form action="{{ route('aprendices.store') }}" method="POST" class="formulario">
        @csrf

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="documento">Documento</label>
            <input type="text" id="documento" name="documento" value="{{ old('documento') }}" required>
            @error('documento')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            @error('correo')<span class="error-campo">{{ $message }}</span>@enderror
        </div>
        <div class="campo">
            <label for="ficha">Ficha</label>
            <input type="number"
                id="ficha"
                name="ficha"
                value="{{ old('ficha') }}"
                required>
            @error('ficha')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Guardar</button>
            <a href="{{ route('aprendices.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection