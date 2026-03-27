@extends('layouts.app')
@section('title', 'Servicios')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-calendar-check me-2"></i>Servicios</h4>
    <a href="{{ route('servicios.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nuevo servicio
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th><th>Nombre</th><th>Área</th><th>Línea</th>
                    <th>Tipo actividad</th><th>Sede</th><th>Fecha</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($servicios as $srv)
            <tr>
                <td>{{ $srv->id_servicio }}</td>
                <td>{{ $srv->nombre }}</td>
                <td>{{ $srv->linea->componente->area->nombre }}</td>
                <td>{{ $srv->linea->nombre }}</td>
                <td>{{ $srv->tipoActividad->nombre }}</td>
                <td>{{ $srv->sede->nombre }}</td>
                <td>{{ $srv->fecha }}</td>
                <td>
                    <a href="{{ route('servicios.participantes', $srv) }}"
                       class="btn btn-info btn-sm" title="Participantes">
                        <i class="bi bi-people"></i>
                    </a>
                    <a href="{{ route('servicios.edit', $srv) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('servicios.destroy', $srv) }}" method="POST"
                          class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center text-muted">Sin servicios registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection