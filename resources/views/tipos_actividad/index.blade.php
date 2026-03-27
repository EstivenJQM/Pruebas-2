@extends('layouts.app')
@section('title', 'Tipos de Actividad')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-list-check me-2"></i>Tipos de Actividad</h4>
    <a href="{{ route('tipos_actividad.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nuevo tipo
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tipos as $tipo)
            <tr>
                <td>{{ $tipo->id_tipo_actividad ?? $tipo->id }}</td>
                <td>{{ $tipo->nombre }}</td>
                <td>
                    <a href="{{ route('tipos_actividad.edit', $tipo) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('tipos_actividad.destroy', $tipo) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este tipo?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">Sin tipos registrados.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection