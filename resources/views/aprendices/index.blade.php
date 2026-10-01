@extends('layouts.app')
@section('title','Aprendices')

@section('content')
<div class="contenedor">
    <div class="encabezado">
        <h1>Aprendices</h1>
        @can('create', App\Models\Aprendiz::class)
            <a href="{{ route('aprendices.create') }}" class="btn-primario btn-nuevo">+ Nuevo</a>
        @endcan
    </div>

    {{-- Formulario de filtros --}}
    <form action="{{ route('aprendices.index') }}" method="GET" class="formulario-filtros">
        <div class="campo">
            <label for="nombre">Buscar por nombre</label>
            <input type="text" id="nombre" name="nombre"
                   value="{{ request('nombre') }}" placeholder="Ej: Juan">
        </div>

        <div class="campo">
            <label for="correo">Buscar por correo</label>
            <input type="text" id="correo" name="correo"
                   value="{{ request('correo') }}" placeholder="Ej: ejemplo@correo.com">
        </div>

        <div class="acciones-filtros">
            <button type="submit" class="btn-primario">Filtrar</button>
            <a href="{{ route('aprendices.index') }}" class="btn-cancelar">Limpiar</a>
        </div>
    </form>

    @if ($aprendices->isEmpty())
        <p class="sin-resultados">No se encontraron aprendices con esos criterios.</p>
    @else
        <div class="tabla-wrap">
            <table class="tabla">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Correo</th>
                        <th>Ficha</th>
                        @can('create', App\Models\Aprendiz::class)
                            <th class="col-acciones">Acciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aprendices as $aprendiz)
                        <tr>
                            <td class="col-id">{{ $aprendiz->id }}</td>
                            <td>{{ $aprendiz->nombre }}</td>
                            <td>{{ $aprendiz->documento }}</td>
                            <td>{{ $aprendiz->correo }}</td>
                            <td>{{ $aprendiz->ficha_id }}</td>

                            @can('create', App\Models\Aprendiz::class)
                                <td class="col-acciones">
                                    @can('update', $aprendiz)
                                        <a href="{{ route('aprendices.edit', $aprendiz) }}" class="btn-mini btn-editar">Editar</a>
                                    @endcan

                                    @can('delete', $aprendiz)
                                        <form action="{{ route('aprendices.destroy', $aprendiz) }}"
                                              method="POST"
                                              class="form-inline"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $aprendiz->nombre }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-mini btn-peligro">Eliminar</button>
                                        </form>
                                    @endcan
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="paginacion">
            {{ $aprendices->links() }}
        </div>

        <p class="resumen">
            Mostrando {{ $aprendices->firstItem() }}–{{ $aprendices->lastItem() }}
            de {{ $aprendices->total() }} aprendices.
        </p>
    @endif
</div>
@endsection