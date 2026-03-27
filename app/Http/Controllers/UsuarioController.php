<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\RolUsuario;
use App\Models\Sede;
use Illuminate\Http\Request;

class UsuarioController extends Controller {

    public function index() {
        $usuarios = Usuario::with('roles.sede')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create() {
        $sedes = Sede::all();
        return view('usuarios.create', compact('sedes'));
    }

    public function store(Request $request) {
        $request->validate([
            'documento'       => 'required|string|max:20|unique:usuario,documento',
            'primer_nombre'   => 'required|string|max:80',
            'segundo_nombre'  => 'nullable|string|max:80',
            'primer_apellido' => 'required|string|max:80',
            'segundo_apellido'=> 'nullable|string|max:80',
            'correo'          => 'required|email|max:150|unique:usuario,correo',
            // Rol inicial opcional
            'id_sede'         => 'nullable|exists:sede,id_sede',
            'rol'             => 'nullable|in:ESTUDIANTE,EMPLEADO,FAMILIAR',
        ]);

        $usuario = Usuario::create($request->only(
            'documento','primer_nombre','segundo_nombre',
            'primer_apellido','segundo_apellido','correo'
        ));

        if ($request->id_sede && $request->rol) {
            RolUsuario::create([
                'id_usuario' => $usuario->id_usuario,
                'id_sede'    => $request->id_sede,
                'rol'        => $request->rol,
            ]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado.');
    }

    public function edit(Usuario $usuario) {
        $sedes = Sede::all();
        return view('usuarios.edit', compact('usuario', 'sedes'));
    }

    public function update(Request $request, Usuario $usuario) {
        $request->validate([
            'primer_nombre'   => 'required|string|max:80',
            'segundo_nombre'  => 'nullable|string|max:80',
            'primer_apellido' => 'required|string|max:80',
            'segundo_apellido'=> 'nullable|string|max:80',
            'correo'          => 'required|email|max:150|unique:usuario,correo,' . $usuario->id_usuario . ',id_usuario',
        ]);
        $usuario->update($request->only(
            'primer_nombre','segundo_nombre',
            'primer_apellido','segundo_apellido','correo'
        ));
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado.');
    }

    public function destroy(Usuario $usuario) {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado.');
    }
}