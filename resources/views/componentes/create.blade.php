@extends('layouts.app')
@section('title', 'Nuevo Componente')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-box-seam me-2"></i>Nuevo Componente</h4>
    <a href="{{ route('componentes.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="card shadow-sm" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('componentes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del componente</label>
                <input type="text" name="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Área</label>
                <select name="id_area"
                        class="form-select @error('id_area') is-invalid @enderror">
                    <option value="">Seleccione un área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id_area }}"
                            {{ old('id_area') == $area->id_area ? 'selected' : '' }}>
                            {{ $area->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('id_area')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>
</div>
@endsection