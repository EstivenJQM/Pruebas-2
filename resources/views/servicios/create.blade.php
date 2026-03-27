@extends('layouts.app')
@section('title', 'Nuevo Servicio')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-calendar-plus me-2"></i>Nuevo Servicio</h4>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>
<div class="card shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form action="{{ route('servicios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre del servicio</label>
                <input type="text" name="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre') }}" placeholder="Ej: Taller de lectura crítica">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Línea</label>
                    <select name="id_linea" id="sel_linea"
                            class="form-select @error('id_linea') is-invalid @enderror">
                        <option value="">— Seleccione —</option>
                        @foreach($lineas as $linea)
                        <option value="{{ $linea->id_linea }}"
                            {{ old('id_linea') == $linea->id_linea ? 'selected':'' }}>
                            {{ $linea->componente->area->nombre }} › {{ $linea->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_linea')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tipo de actividad</label>
                    <select name="id_tipo_actividad"
                            class="form-select @error('id_tipo_actividad') is-invalid @enderror">
                        <option value="">— Seleccione —</option>
                        @foreach($tiposActividad as $tipo)
                        <option value="{{ $tipo->id_tipo_actividad }}"
                            {{ old('id_tipo_actividad') == $tipo->id_tipo_actividad ? 'selected':'' }}>
                            {{ $tipo->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_tipo_actividad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Sede</label>
                    <select name="id_sede"
                            class="form-select @error('id_sede') is-invalid @enderror">
                        <option value="">— Seleccione —</option>
                        @foreach($sedes as $sede)
                        <option value="{{ $sede->id_sede }}"
                            {{ old('id_sede') == $sede->id_sede ? 'selected':'' }}>
                            {{ $sede->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_sede')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fecha</label>
                    <input type="date" name="fecha"
                           class="form-control @error('fecha') is-invalid @enderror"
                           value="{{ old('fecha', date('Y-m-d')) }}">
                    @error('fecha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <button class="btn btn-primary w-100">
                <i class="bi bi-save me-1"></i>Guardar servicio
            </button>
        </form>
    </div>
</div>
@endsection