<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;

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

    public function edit(Kriteria $kriterium) {
        return view('kriteria.edit', compact('kriterium'));
    }

    public function update(Request $request, Kriteria $kriterium) {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required|numeric',
            'jenis_kriteria' => 'required|in:Cost,Benefit',
        ]);

        $kriterium->update($request->all());
        return redirect()->route('kriteria.index');
    }

    public function destroy(Kriteria $kriterium) {
        $kriterium->delete();
        return redirect()->route('kriteria.index');
    }
}
