<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Kriteria $kriterium)
    {
        $kriteria = Kriteria::with('subKriteria')->get();
        return view('subkriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kriteria $kriterium)
    {
        return view('subkriteria.create', compact('kriterium'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Kriteria $kriterium)
    {
        $request->validate([
            'nama_sub_kriteria' => 'required',
            'nilai' => 'required|integer',
        ]);

        $kriterium->subKriteria()->create($request->all());
        return redirect()->route('subkriteria.index', $kriterium->kode_kriteria)->with('success', 'Sub Kriteria created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriterium, SubKriteria $subKriteria)
    {
        $kriterium = Kriteria::where('kode_kriteria', $kriterium->kode_kriteria)->first();
        $subKriteria = SubKriteria::findOrFail($subKriteria->Id);

        return view('subkriteria.edit', compact('kriterium', 'subKriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium, SubKriteria $subKriterium)
    {
        
        $request->validate([
            'nama_sub_kriteria' => 'required',
            'nilai' => 'required|integer',
        ]);

        $subKriterium->update($request->all());
        return redirect()->route('subkriteria.index', $kriterium->kode_kriteria)->with('success', 'Sub Kriteria updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium, SubKriteria $subKriterium)
    {
        $subKriterium->delete();
        return redirect()->route('subkriteria.index', $kriterium->kode_kriteria)->with('success', 'Sub Kriteria deleted successfully.');
    }
}
