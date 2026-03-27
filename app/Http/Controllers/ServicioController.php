<?php
namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Linea;
use App\Models\TipoActividad;
use App\Models\Sede;
use Illuminate\Http\Request;

class ServicioController extends Controller {

    public function index() {
        $servicios = Servicio::with(['linea.componente.area', 'tipoActividad', 'sede'])
                             ->orderByDesc('fecha')->get();
        return view('servicios.index', compact('servicios'));
    }

    public function create() {
        $lineas         = Linea::with('componente.area')->get();
        $tiposActividad = TipoActividad::all();
        $sedes          = Sede::all();
        return view('servicios.create', compact('lineas', 'tiposActividad', 'sedes'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre'            => 'required|string|max:200',
            'id_linea'          => 'required|exists:linea,id_linea',
            'id_tipo_actividad' => 'required|exists:tipo_actividad,id_tipo_actividad',
            'id_sede'           => 'required|exists:sede,id_sede',
            'fecha'             => 'required|date',
        ]);
        Servicio::create($request->only('nombre','id_linea','id_tipo_actividad','id_sede','fecha'));
        return redirect()->route('servicios.index')->with('success', 'Servicio registrado.');
    }

    public function edit(Servicio $servicio) {
        $lineas         = Linea::with('componente.area')->get();
        $tiposActividad = TipoActividad::all();
        $sedes          = Sede::all();
        return view('servicios.edit', compact('servicio', 'lineas', 'tiposActividad', 'sedes'));
    }

    public function update(Request $request, Servicio $servicio) {
        $request->validate([
            'nombre'            => 'required|string|max:200',
            'id_linea'          => 'required|exists:linea,id_linea',
            'id_tipo_actividad' => 'required|exists:tipo_actividad,id_tipo_actividad',
            'id_sede'           => 'required|exists:sede,id_sede',
            'fecha'             => 'required|date',
        ]);
        $servicio->update($request->only('nombre','id_linea','id_tipo_actividad','id_sede','fecha'));
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy(Servicio $servicio) {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado.');
    }

    // Vista para gestionar participantes del servicio
    public function participantes(Servicio $servicio) {
        $servicio->load('participantes.usuario', 'participantes.sede');
        return view('servicios.participantes', compact('servicio'));
    }
}