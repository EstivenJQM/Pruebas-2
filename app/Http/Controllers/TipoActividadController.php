<?php
namespace App\Http\Controllers;

use App\Models\TipoActividad;
use Illuminate\Http\Request;

class TipoActividadController extends Controller {

    public function index() {
        $tipos = TipoActividad::all();
        return view('tipos_actividad.index', compact('tipos'));
    }

    public function create() {
        return view('tipos_actividad.create');
    }

    public function store(Request $request) {
        $request->validate(['nombre' => 'required|string|max:120']);
        TipoActividad::create($request->only('nombre'));
        return redirect()->route('tipos_actividad.index')->with('success', 'Tipo de actividad creado.');
    }

    public function edit(TipoActividad $tiposActividad) {
        return view('tipos_actividad.edit', ['tipo' => $tiposActividad]);
    }

    public function update(Request $request, TipoActividad $tiposActividad) {
        $request->validate(['nombre' => 'required|string|max:120']);
        $tiposActividad->update($request->only('nombre'));
        return redirect()->route('tipos_actividad.index')->with('success', 'Tipo actualizado.');
    }

    public function destroy(TipoActividad $tiposActividad) {
        $tiposActividad->delete();
        return redirect()->route('tipos_actividad.index')->with('success', 'Tipo eliminado.');
    }
}