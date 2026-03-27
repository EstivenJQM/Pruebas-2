@extends('layouts.app')
@section('title', 'Nuevo Tipo de Actividad')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-list-check me-2"></i>Nuevo Tipo de Actividad</h4>
    <a href="{{ route('tipos_actividad.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="card shadow-sm" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('tipos_actividad.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>
</div>
@endsection