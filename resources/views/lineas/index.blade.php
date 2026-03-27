@extends('layouts.app')
@section('title', 'Líneas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-diagram-2 me-2"></i>Líneas</h4>
    <a href="{{ route('lineas.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nueva línea
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
                    <th>Componente</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($lineas as $linea)
            <tr>
                <td>{{ $linea->id_linea ?? $linea->id }}</td>
                <td>{{ $linea->nombre }}</td>
                <td>{{ $linea->componente->nombre ?? '' }}</td>
                <td>{{ $linea->componente->area->nombre ?? '' }}</td>
                <td>
                    <a href="{{ route('lineas.edit', $linea) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('lineas.destroy', $linea) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar esta línea?')">
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
                <td colspan="5" class="text-center text-muted">Sin líneas registradas.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection