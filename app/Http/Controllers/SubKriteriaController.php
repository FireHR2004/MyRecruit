<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteria;
use App\Models\Kriteria;

class SubKriteriaController extends Controller
{
    public function index() {
        $subKriteria = SubKriteria::with('kriteria')->get();
        return view('subkriteria.index', compact('subKriteria'));
    }

    public function create(Request $request)
    {
        $kriteria = Kriteria::all();
        $selectedKriteria = $request->input('kriteria_id');
        return view('subkriteria.create', compact('kriteria', 'selectedKriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_sub_kriteria' => 'required',
            'nilai_sub_kriteria' => 'required|integer',
        ]);

        SubKriteria::create($request->all());
        return redirect()->route('subkriteria.index');
    }

    public function edit(SubKriteria $subKriteria)
    {
        $kriteria = Kriteria::all();
        return view('subkriteria.edit', compact('subKriteria', 'kriteria'));
    }

    public function update(Request $request, SubKriteria $subKriteria){
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_sub_kriteria' => 'required',
            'nilai_sub_kriteria' => 'required|integer',
        ]);

        $subKriteria->update($request->all());
        return redirect()->route('subkriteria.index');
    }

    public function destroy(SubKriteria $subKriteria) {
        $subKriteria->delete();
        return redirect()->route('subkriteria.index');
    }
}
