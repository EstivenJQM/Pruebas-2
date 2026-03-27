@extends('layouts.app')
@section('title', 'Áreas')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-diagram-3 me-2"></i>Áreas</h4>
    <a href="{{ route('areas.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nueva área
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Nombre</th><th>Acciones</th></tr></thead>
            <tbody>
            @forelse($areas as $area)
            <tr>
                <td>{{ $area->id_area }}</td>
                <td>{{ $area->nombre }}</td>
                <td>
                    <a href="{{ route('areas.edit', $area) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('areas.destroy', $area) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar esta área?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center text-muted">Sin áreas registradas.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection