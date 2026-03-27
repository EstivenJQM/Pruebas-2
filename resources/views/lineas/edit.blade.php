@extends('layouts.app')
@section('title', 'Editar Línea')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-pencil me-2"></i>Editar Línea</h4>
    <a href="{{ route('lineas.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body">
        <form action="{{ route('lineas.update', $linea) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $linea->nombre) }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Componente</label>
                <select name="id_componente"
                        class="form-select @error('id_componente') is-invalid @enderror">
                    <option value="">Seleccione un componente</option>
                    @foreach($componentes as $comp)
                        <option value="{{ $comp->id_componente }}"
                            {{ old('id_componente', $linea->id_componente) == $comp->id_componente ? 'selected' : '' }}>
                            {{ $comp->nombre }} ({{ $comp->area->nombre ?? '' }})
                        </option>
                    @endforeach
                </select>
                @error('id_componente')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tipos de actividad</label>
                @foreach($tiposActividad as $tipo)
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="tipos_actividad[]"
                           value="{{ $tipo->id_tipo_actividad }}"
                           {{ in_array($tipo->id_tipo_actividad, old('tipos_actividad', $seleccionados)) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $tipo->nombre }}
                    </label>
                </div>
                @endforeach
            </div>

            <button class="btn btn-warning w-100">Actualizar</button>
        </form>
    </div>
</div>
@endsection