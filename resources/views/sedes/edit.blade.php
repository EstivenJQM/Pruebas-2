@extends('layouts.app')
@section('title', 'Editar Sede')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-pencil me-2"></i>Editar Sede</h4>
    <a href="{{ route('sedes.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>
<div class="card shadow-sm" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('sedes.update', $sede) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nombre de la sede</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $sede->nombre) }}">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-warning w-100">Actualizar</button>
        </form>
    </div>
</div>
@endsection