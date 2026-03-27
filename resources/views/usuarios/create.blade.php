@extends('layouts.app')
@section('title', 'Nuevo Usuario')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-person-plus me-2"></i>Nuevo Usuario</h4>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>
<div class="card shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-2">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Documento *</label>
                    <input type="text" name="documento" class="form-control @error('documento') is-invalid @enderror"
                           value="{{ old('documento') }}">
                    @error('documento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Correo electrónico *</label>
                    <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
                           value="{{ old('correo') }}">
                    @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Primer nombre *</label>
                    <input type="text" name="primer_nombre" class="form-control" value="{{ old('primer_nombre') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Segundo nombre</label>
                    <input type="text" name="segundo_nombre" class="form-control" value="{{ old('segundo_nombre') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Primer apellido *</label>
                    <input type="text" name="primer_apellido" class="form-control" value="{{ old('primer_apellido') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Segundo apellido</label>
                    <input type="text" name="segundo_apellido" class="form-control" value="{{ old('segundo_apellido') }}">
                </div>
            </div>

            <hr class="my-3">
            <p class="text-muted small">Rol inicial (opcional)</p>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Sede</label>
                    <select name="id_sede" class="form-select">
                        <option value="">— Sin rol inicial —</option>
                        @foreach($sedes as $sede)
                        <option value="{{ $sede->id_sede }}">{{ $sede->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Rol</label>
                    <select name="rol" class="form-select">
                        <option value="">— Seleccione —</option>
                        <option value="ESTUDIANTE">Estudiante</option>
                        <option value="EMPLEADO">Empleado</option>
                        <option value="FAMILIAR">Familiar</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary w-100">
                <i class="bi bi-save me-1"></i>Guardar usuario
            </button>
        </form>
    </div>
</div>
@endsection