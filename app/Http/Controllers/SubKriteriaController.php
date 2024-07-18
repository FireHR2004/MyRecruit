<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteria;
use App\Models\Kriteria;

class SubKriteriaController extends Controller
{
    public function index() {
        $subKriteria = SubKriteria::with('kriteria')->get();
        return view('sub_kriteria.index', compact('subKriteria'));
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        return view('sub_kriteria.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_sub_kriteria' => 'required',
            'nilai_sub_kriteria' => 'required|integer',
        ]);

        SubKriteria::create($request->all());
        return redirect()->route('sub_kriteria.index');
    }

    public function edit(SubKriteria $subKriteria)
    {
        $kriteria = Kriteria::all();
        return view('sub_kriteria.edit', compact('subKriteria', 'kriteria'));
    }

    public function update(Request $request, SubKriteria $subKriteria){
        $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_sub_kriteria' => 'required',
            'nilai_sub_kriteria' => 'required|integer',
        ]);

        $subKriteria->update($request->all());
        return redirect()->route('sub_kriteria.index');
    }

    public function destroy(SubKriteria $subKriteria) {
        $subKriteria->delete();
        return redirect()->route('sub_kriteria.index');
    }
}
