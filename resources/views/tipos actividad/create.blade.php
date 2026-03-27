@extends('layouts.app')
@section('title', 'Nuevo tipo de actividad')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-diagram-3 me-2"></i>Nuevo tipo de actividad</h4>
    <a href="{{ route('areas.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>
<div class="card shadow-sm" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('areas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre del tipo de actividad</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre') }}">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>
</div>
@endsection