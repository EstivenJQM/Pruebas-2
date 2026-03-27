<?php
namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\Area;
use Illuminate\Http\Request;

class ComponenteController extends Controller {

    public function index() {
        $componentes = Componente::with('area')->get();
        return view('componentes.index', compact('componentes'));
    }

    public function create() {
        $areas = Area::all();
        return view('componentes.create', compact('areas'));
    }

    public function store(Request $request) {
        $request->validate([
            'nombre'  => 'required|string|max:120',
            'id_area' => 'required|exists:area,id_area',
        ]);
        Componente::create($request->only('nombre', 'id_area'));
        return redirect()->route('componentes.index')->with('success', 'Componente creado.');
    }

    public function edit(Componente $componente) {
        $areas = Area::all();
        return view('componentes.edit', compact('componente', 'areas'));
    }

    public function update(Request $request, Componente $componente) {
        $request->validate([
            'nombre'  => 'required|string|max:120',
            'id_area' => 'required|exists:area,id_area',
        ]);
        $componente->update($request->only('nombre', 'id_area'));
        return redirect()->route('componentes.index')->with('success', 'Componente actualizado.');
    }

    public function destroy(Componente $componente) {
        $componente->delete();
        return redirect()->route('componentes.index')->with('success', 'Componente eliminado.');
    }
}