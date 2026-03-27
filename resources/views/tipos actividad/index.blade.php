@extends('layouts.app')
@section('title', 'tipos_actividad')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-diagram-3 me-2"></i>tipos_actividad</h4>
    <a href="{{ route('tipos_actividad.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nueva área
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Nombre</th><th>Acciones</th></tr></thead>
            <tbody>
            @forelse($tipos_actividad as $tipo_actividad)
            <tr>
                <td>{{ $tipo_actividad->id_tipo_actividad }}</td>
                <td>{{ $tipo_actividad->nombre }}</td>
                <td>
                    <a href="{{ route('tipos_actividad.edit', $tipo_actividad) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('tipos_actividad.destroy', $tipo_actividad) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este tipo de actividad?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center text-muted">Sin tipos de actividad registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection