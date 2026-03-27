@extends('layouts.app')
@section('title', 'Participantes')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0"><i class="bi bi-people me-2"></i>Participantes del servicio</h4>
        <small class="text-muted">{{ $servicio->nombre }} — {{ $servicio->fecha }}</small>
    </div>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="row g-4">

    {{-- PANEL IZQUIERDO: Buscador de usuarios --}}
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-semibold">
                <i class="bi bi-search me-2"></i>Buscar usuario por cédula
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Número de documento</label>
                    <input type="text" id="inp_doc" class="form-control"
                           placeholder="Ej: 1234567890">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <select id="inp_rol" class="form-select">
                        <option value="">— Seleccione rol —</option>
                        <option value="ESTUDIANTE">Estudiante</option>
                        <option value="EMPLEADO">Empleado</option>
                        <option value="FAMILIAR">Familiar</option>
                    </select>
                </div>
                <button id="btn_buscar" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i>Buscar
                </button>

                {{-- Resultado de búsqueda —— se arrastra al panel derecho --}}
                <div id="resultado" class="mt-3" style="display:none">
                    <p class="text-muted small mb-2">
                        Arrastra la tarjeta al panel de participantes o usa el botón:
                    </p>
                    <div id="card_usuario"
                         draggable="true"
                         class="border rounded p-3 bg-light d-flex align-items-center gap-3"
                         style="cursor:grab">
                        <i class="bi bi-person-circle fs-2 text-primary"></i>
                        <div>
                            <strong id="r_nombre"></strong><br>
                            <small class="text-muted">CC: <span id="r_doc"></span></small><br>
                            <span id="r_rol" class="badge bg-secondary"></span>
                            <span id="r_sede" class="badge bg-info text-dark"></span>
                        </div>
                    </div>
                    <input type="hidden" id="r_id_rol_usuario">
                    <button id="btn_agregar" class="btn btn-success btn-sm mt-2 w-100">
                        <i class="bi bi-person-plus me-1"></i>Agregar al servicio
                    </button>
                </div>

                <div id="msg_error" class="alert alert-danger mt-3" style="display:none"></div>
            </div>
        </div>
    </div>

    {{-- PANEL DERECHO: Lista de participantes --}}
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-semibold">
                <i class="bi bi-list-check me-2"></i>
                Participantes registrados
                <span class="badge bg-primary ms-2">{{ $servicio->participantes->count() }}</span>
            </div>
            <div id="drop_zone"
                 class="card-body p-2"
                 style="min-height:200px; border: 2px dashed transparent; transition:.2s">
                @forelse($servicio->participantes as $rp)
                <div class="d-flex justify-content-between align-items-center
                            border rounded px-3 py-2 mb-2 bg-white">
                    <div>
                        <strong>{{ $rp->usuario->primer_nombre }} {{ $rp->usuario->primer_apellido }}</strong><br>
                        <small class="text-muted">CC: {{ $rp->usuario->documento }}</small>
                        <span class="badge bg-secondary ms-1">{{ $rp->rol }}</span>
                        <span class="badge bg-info text-dark">{{ $rp->sede->nombre }}</span>
                    </div>
                    <form action="{{ route('servicios.quitar', [$servicio, $rp]) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" title="Quitar">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-center text-muted mt-4" id="empty_msg">
                    Aún no hay participantes. Busca y arrastra un usuario aquí.
                </p>
                @endforelse
            </div>
        </div>
    </div>

</div>

{{-- Formulario oculto para agregar --}}
<form id="form_agregar" action="{{ route('servicios.agregar', $servicio) }}" method="POST" style="display:none">
    @csrf
    <input type="hidden" name="id_rol_usuario" id="f_id_rol_usuario">
</form>

@push('scripts')
<script>
const meta = document.querySelector('meta[name=csrf-token]');
const CSRF = meta ? meta.getAttribute('content') : '';

// ── Buscar usuario ──────────────────────────────────────────
document.getElementById('btn_buscar').addEventListener('click', async () => {
    const doc = document.getElementById('inp_doc').value.trim();
    const rol = document.getElementById('inp_rol').value;
    const err = document.getElementById('msg_error');
    const res = document.getElementById('resultado');
    err.style.display = 'none';
    res.style.display  = 'none';

    if (!doc || !rol) { err.textContent = 'Ingresa documento y rol.'; err.style.display='block'; return; }

    const resp = await fetch(`{{ route('servicios.buscar', $servicio) }}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ documento: doc, rol })
    });
    const data = await resp.json();

    if (!resp.ok) { err.textContent = data.error; err.style.display='block'; return; }

    document.getElementById('r_nombre').textContent = data.nombre;
    document.getElementById('r_doc').textContent    = data.documento;
    document.getElementById('r_rol').textContent    = data.rol;
    document.getElementById('r_sede').textContent   = data.sede;
    document.getElementById('r_id_rol_usuario').value = data.id_rol_usuario;
    res.style.display = 'block';
});

// ── Botón agregar ───────────────────────────────────────────
document.getElementById('btn_agregar').addEventListener('click', () => submitAgregar());

function submitAgregar() {
    const id = document.getElementById('r_id_rol_usuario').value;
    if (!id) return;
    document.getElementById('f_id_rol_usuario').value = id;
    document.getElementById('form_agregar').submit();
}

// ── Drag & Drop ─────────────────────────────────────────────
const card    = document.getElementById('card_usuario');
const dropZone = document.getElementById('drop_zone');

card.addEventListener('dragstart', e => {
    e.dataTransfer.setData('text/plain', document.getElementById('r_id_rol_usuario').value);
});

dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.style.border = '2px dashed #0d6efd';
    dropZone.style.background = '#f0f4ff';
});
dropZone.addEventListener('dragleave', () => {
    dropZone.style.border = '2px dashed transparent';
    dropZone.style.background = '';
});
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.border = '2px dashed transparent';
    dropZone.style.background = '';
    submitAgregar(); // usa el mismo formulario
});
</script>
@endpush
@endsection