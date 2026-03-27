@extends('layouts.app')
@section('title', 'Componentes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-box-seam me-2"></i>Componentes</h4>
    <a href="{{ route('componentes.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nuevo componente
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($componentes as $componente)
            <tr>
                <td>{{ $componente->id_componente ?? $componente->id }}</td>
                <td>{{ $componente->nombre }}</td>
                <td>{{ $componente->area->nombre ?? 'Sin área' }}</td>
                <td>
                    <a href="{{ route('componentes.edit', $componente) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('componentes.destroy', $componente) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este componente?')">
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
                <td colspan="4" class="text-center text-muted">Sin componentes registrados.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection