<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index() {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    public function create() {
        return view('kriteria.create');
    }

    public function store(Request $request) {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required|numeric',
            'jenis_kriteria' => 'required|in:Cost,Benefit',
        ]);

        Kriteria::create($request->all());
        return redirect()->route('kriteria.index');
    }

    public function edit(Kriteria $kriteria) {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria) {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required|numeric',
            'jenis_kriteria' => 'required|in:Cost,Benefit',
        ]);

        $kriteria->update($request->all());
        return redirect()->route('kriteria.index');
    }

    public function destroy(Kriteria $kriteria) {
        $kriteria->delete();
        return redirect()->route('kriteria.index');
    }
}
