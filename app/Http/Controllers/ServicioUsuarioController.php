<?php
namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\RolUsuario;
use Illuminate\Http\Request;

class ServicioUsuarioController extends Controller {

    // Busca usuario por cédula + rol (AJAX)
    public function buscar(Request $request) {
        $request->validate([
            'documento' => 'required|string',
            'rol'       => 'required|in:ESTUDIANTE,EMPLEADO,FAMILIAR',
        ]);

        $usuario = Usuario::where('documento', $request->documento)->first();

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $rolUsuario = RolUsuario::where('id_usuario', $usuario->id_usuario)
                                ->where('rol', $request->rol)
                                ->with('sede')
                                ->first();

        if (!$rolUsuario) {
            return response()->json(['error' => 'El usuario no tiene ese rol registrado.'], 404);
        }

        return response()->json([
            'id_rol_usuario'  => $rolUsuario->id_rol_usuario,
            'nombre'          => $usuario->primer_nombre . ' ' . $usuario->primer_apellido,
            'documento'       => $usuario->documento,
            'rol'             => $rolUsuario->rol,
            'sede'            => $rolUsuario->sede->nombre,
        ]);
    }

    // Agregar participante al servicio
    public function agregar(Request $request, Servicio $servicio) {
        $request->validate([
            'id_rol_usuario' => 'required|exists:rol_usuario,id_rol_usuario',
        ]);

        // Evitar duplicados
        if ($servicio->participantes()->where('id_rol_usuario', $request->id_rol_usuario)->exists()) {
            return back()->with('error', 'El usuario ya está en este servicio.');
        }

        $servicio->participantes()->attach($request->id_rol_usuario);
        return back()->with('success', 'Participante agregado.');
    }

    // Quitar participante del servicio
    public function quitar(Servicio $servicio, RolUsuario $rolUsuario) {
        $servicio->participantes()->detach($rolUsuario->id_rol_usuario);
        return back()->with('success', 'Participante removido.');
    }
}