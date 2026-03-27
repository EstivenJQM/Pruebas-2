<?php
namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Componente;
use App\Models\TipoActividad;
use Illuminate\Http\Request;

class LineaController extends Controller {

    public function index() {
        $lineas = Linea::with('componente.area')->get();
        return view('lineas.index', compact('lineas'));
    }

    public function create() {
        $componentes   = Componente::with('area')->get();
        $tiposActividad = TipoActividad::all();
        return view('lineas.create', compact('componentes', 'tiposActividad'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre'         => 'required|string|max:120',
            'id_componente'  => 'required|exists:componente,id_componente',
            'tipos_actividad' => 'array',
            'tipos_actividad.*' => 'exists:tipo_actividad,id_tipo_actividad',
        ]);
        $linea = Linea::create($request->only('nombre', 'id_componente'));
        if ($request->tipos_actividad) {
            $linea->tiposActividad()->sync($request->tipos_actividad);
        }
        return redirect()->route('lineas.index')->with('success', 'Línea creada.');
    }

    public function edit(Linea $linea) {
        $componentes    = Componente::with('area')->get();
        $tiposActividad = TipoActividad::all();
        $seleccionados  = $linea->tiposActividad->pluck('id_tipo_actividad')->toArray();
        return view('lineas.edit', compact('linea', 'componentes', 'tiposActividad', 'seleccionados'));
    }

    public function update(Request $request, Linea $linea) {
        $request->validate([
            'nombre'          => 'required|string|max:120',
            'id_componente'   => 'required|exists:componente,id_componente',
            'tipos_actividad' => 'array',
            'tipos_actividad.*' => 'exists:tipo_actividad,id_tipo_actividad',
        ]);
        $linea->update($request->only('nombre', 'id_componente'));
        $linea->tiposActividad()->sync($request->tipos_actividad ?? []);
        return redirect()->route('lineas.index')->with('success', 'Línea actualizada.');
    }

    public function destroy(Linea $linea) {
        $linea->delete();
        return redirect()->route('lineas.index')->with('success', 'Línea eliminada.');
    }
}