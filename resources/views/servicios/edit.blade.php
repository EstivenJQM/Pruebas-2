@extends('layouts.app')
@section('title', 'Editar Servicio')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-pencil me-2"></i>Editar Servicio #{{ $servicio->id_servicio }}</h4>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>
<div class="card shadow-sm" style="max-width:640px">
    <div class="card-body">
        <form action="{{ route('servicios.update', $servicio) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" class="form-control"
                       value="{{ old('nombre', $servicio->nombre) }}">
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Línea</label>
                    <select name="id_linea" class="form-select">
                        @foreach($lineas as $linea)
                        <option value="{{ $linea->id_linea }}"
                            {{ $servicio->id_linea == $linea->id_linea ? 'selected':'' }}>
                            {{ $linea->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tipo de actividad</label>
                    <select name="id_tipo_actividad" class="form-select">
                        @foreach($tiposActividad as $tipo)
                        <option value="{{ $tipo->id_tipo_actividad }}"
                            {{ $servicio->id_tipo_actividad == $tipo->id_tipo_actividad ? 'selected':'' }}>
                            {{ $tipo->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Sede</label>
                    <select name="id_sede" class="form-select">
                        @foreach($sedes as $sede)
                        <option value="{{ $sede->id_sede }}"
                            {{ $servicio->id_sede == $sede->id_sede ? 'selected':'' }}>
                            {{ $sede->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fecha</label>
                    <input type="date" name="fecha" class="form-control"
                           value="{{ old('fecha', $servicio->fecha) }}">
                </div>
            </div>

            <button class="btn btn-warning w-100">Actualizar</button>
        </form>
    </div>
</div>
@endsection