<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function index() {
        $criteria = Criteria::all();
        return view('criteria.index', compact('criteria'));
    }

    public function create() {
        return view('criteria.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
            'jenis' => 'required|in:Cost,Benefit',
        ]);

        Criteria::create($validated);
        return redirect()->route('criteria.index');
    }

    public function edit(Criteria $criterion) {
        return view('criteria.edit', compact('criterion'));
    }

    public function update(Request $request, Criteria $criterion) {
        $validated = $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
            'jenis' => 'required|in:Cost,Benefit',
        ]);

        $criterion->update($validated);
        return redirect()->route('criteria.index');
    }

    public function destroy(Criteria $criterion) {
        $criterion->delete();
        return redirect()->route('criteria.index');
    }
}
