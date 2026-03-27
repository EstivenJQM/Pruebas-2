@extends('layouts.app')
@section('title', 'Editar tipo de actividad')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-pencil me-2"></i>Editar tipo de actividad</h4>
    <a href="{{ route('tipos_actividad.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>
<div class="card shadow-sm" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('tipos_actividad.update', $tipo_actividad) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nombre del tipo de actividad</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $tipo_actividad->nombre) }}">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-warning w-100">Actualizar</button>
        </form>
    </div>
</div>
@endsection