<?php
namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller {

    public function index() {
        $areas = Area::all();
        return view('areas.index', compact('areas'));
    }

    public function create() {
        return view('areas.create');
    }

    public function store(Request $request) {
        $request->validate(['nombre' => 'required|string|max:120']);
        Area::create($request->only('nombre'));
        return redirect()->route('areas.index')->with('success', 'Área creada.');
    }

    public function edit(Area $area) {
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area) {
        $request->validate(['nombre' => 'required|string|max:120']);
        $area->update($request->only('nombre'));
        return redirect()->route('areas.index')->with('success', 'Área actualizada.');
    }

    public function destroy(Area $area) {
        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Área eliminada.');
    }
}