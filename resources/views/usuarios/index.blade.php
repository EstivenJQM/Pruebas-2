@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-people me-2"></i>Usuarios</h4>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Nuevo usuario
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr><th>Doc</th><th>Nombre completo</th><th>Correo</th><th>Roles</th><th>Acciones</th></tr>
            </thead>
            <tbody>
            @forelse($usuarios as $u)
            <tr>
                <td>{{ $u->documento }}</td>
                <td>{{ $u->nombre_completo }}</td>
                <td>{{ $u->correo }}</td>
                <td>
                    @foreach($u->roles as $r)
                    <span class="badge bg-secondary">{{ $r->rol }} — {{ $r->sede->nombre }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('usuarios.edit', $u) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('usuarios.destroy', $u) }}" method="POST"
                          class="d-inline" onsubmit="return confirm('¿Eliminar usuario?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted">Sin usuarios.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection