<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCriteria;
use App\Models\Criteria;

class SubCriteriaController extends Controller
{
    public function index() {
        $criteria = Criteria::with('subCriteria')->get();
        return view('subcriteria.index', compact('criteria'));
    }

    public function create() {
        $criteria = Criteria::all();
        return view('subcriteria.create', compact('criteria'));
    }

    public function store(Request $request) {
        $request->validate([
            'criterion_id' => 'required|exists:criteria,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai' => 'required|integer',
        ]);

        SubCriteria::create($request->all());
        return redirect()->route('subcriteria.index')->with('success', 'Sub Kriteria created successfully.');
    }

    public function edit(SubCriteria $subCriteria) {
        $criteria = Criteria::all();
        return view('subcriteria.edit', compact('subCriteria', 'criteria'));
    }

    public function update(Request $request, SubCriteria $subCriteria) {
        $request->validate([
            'criterion_id' => 'required|exists:criteria,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai' => 'required|integer',
        ]);

        $subCriteria->update($request->all());
        return redirect()->route('subcriteria.index')->with('success', 'Sub Kriteria updated successfully.');
    }

    public function destroy(SubCriteria $subCriteria) {
        $subCriteria->delete();
        return redirect()->route('subcriteria.index')->with('success', 'Sub Kriteria deleted successfully.');
    }
}
