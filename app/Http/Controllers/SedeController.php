<?php
namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller {

    public function index() {
        $sedes = Sede::all();
        return view('sedes.index', compact('sedes'));
    }

    public function create() {
        return view('sedes.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:120',
            'codigo' => 'required|string|max:20|unique:sede,codigo',
        ]);
        Sede::create($request->only('nombre', 'codigo'));
        return redirect()->route('sedes.index')->with('success', 'Sede creada.');
    }

    public function edit(Sede $sede) {
        return view('sedes.edit', compact('sede'));
    }

    public function update(Request $request, Sede $sede) {
        $request->validate([
            'nombre' => 'required|string|max:120',
            'codigo' => 'required|string|max:20|unique:sede,codigo,' . $sede->id_sede . ',id_sede',
        ]);
        $sede->update($request->only('nombre', 'codigo'));
        return redirect()->route('sedes.index')->with('success', 'Sede actualizada.');
    }

    public function destroy(Sede $sede) {
        $sede->delete();
        return redirect()->route('sedes.index')->with('success', 'Sede eliminada.');
    }
}