@extends('layouts.app')
@section('title','Usuarios')

@section('content')
<div class="contenedor">
    <div class="encabezado">
        <h1>Usuarios del sistema</h1>
        <a href="{{ route('users.create') }}" class="btn-primario btn-nuevo">+ Nuevo usuario</a>
    </div>

    <form action="{{ route('users.index') }}" method="GET" class="formulario-filtros">
        <div class="campo">
            <label for="name">Buscar por nombre</label>
            <input type="text" id="name" name="name"
                value="{{ request('name') }}" placeholder="Ej: Juan">
        </div>

        <div class="campo">
            <label for="email">Buscar por correo</label>
            <input type="text" id="email" name="email"
                value="{{ request('email') }}" placeholder="Ej: correo@dominio.com">
        </div>

        <div class="campo">
            <label for="role">Rol</label>
            <select id="role" name="role">
                <option value="">Todos</option>
                <option value="administrador" @selected(request('role')==='administrador' )>Administrador</option>
                <option value="instructor" @selected(request('role')==='instructor' )>Instructor</option>
                <option value="aprendiz" @selected(request('role')==='aprendiz' )>Aprendiz</option>
            </select>
        </div>

        <div class="acciones-filtros">
            <button type="submit" class="btn-primario">Filtrar</button>
            <a href="{{ route('users.index') }}" class="btn-cancelar">Limpiar</a>
        </div>
    </form>

    @if ($users->isEmpty())
    <p class="sin-resultados">No se encontraron usuarios con esos criterios.</p>
    @else
    <div class="tabla-wrap">
        <table class="tabla">
            <thead>
                <tr>
                    <th class="col-id">#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="col-id">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="rol-badge rol-{{ $user->role }}">{{ $user->role }}</span>
                    </td>
                    <td class="col-acciones">
                        <a href="{{ route('users.edit', $user) }}" class="btn-mini btn-editar">Editar</a>

                        @can('delete', $user)
                        <form action="{{ route('users.destroy', $user) }}"
                            method="POST"
                            class="form-inline"
                            onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $user->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-mini btn-peligro">Eliminar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="paginacion">{{ $users->links() }}</div>

    <p class="resumen">
        Mostrando {{ $users->firstItem() }}–{{ $users->lastItem() }}
        de {{ $users->total() }} usuarios.
    </p>
    @endif
</div>
@endsection