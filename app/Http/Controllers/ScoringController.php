<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Scoring;
use Illuminate\Http\Request;

class ScoringController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('scoring.index', compact('alternatifs'));
    }

    public function edit($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $kriterias = Kriteria::all();
        $subKriterias = SubKriteria::all();
        
        return view('scoring.edit', compact('alternatif', 'kriterias', 'subKriterias'));
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        foreach ($request->kriteria as $kriteriaId => $subKriteriaId) {
            Scoring::updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $kriteriaId
                ],
                [
                    'sub_kriteria_id' => $subKriteriaId
                ]
            );
        }

        return redirect()->route('scoring.index')->with('success', 'Scoring updated successfully');
    }
}
