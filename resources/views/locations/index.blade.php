{{-- filepath: resources/views/locations/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ubicaciones</h1>

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Botón para crear un nuevo sitio --}}
    <a href="{{ route('locations.create') }}" class="btn btn-primary mb-3">Crear ubicación</a>

    {{-- Tabla de sitios --}}
    <form action="{{ route('locations.destroyMultiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $location->id }}"></td>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->description }}</td>
                    <td class="text-center">
                        <a href="{{ route('locations.edit', $location) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('locations.destroy', $location) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta ubicación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('¿Estás seguro de que deseas eliminar las ubicaciones seleccionados?')">
            Eliminar Seleccionados
        </button>
    </form>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $locations->links() }}
    </div>
</div>
@endsection
