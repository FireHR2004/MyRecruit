<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scoring;
use App\Models\Kriteria;
use App\Models\Alternatif;

class PerhitunganController extends Controller
{
    public function index()
    {
        // Fetch scoring data with related models
        $scorings = Scoring::with(['alternatif', 'kriteria', 'subKriteria'])->get();
        $kriteria = Kriteria::all();
        $alternatifs = Alternatif::all();

        // Calculate the average for each criteria
        $kriteriaAverage = [];
        foreach ($kriteria as $k) {
            $total = $scorings->where('kriteria_id', $k->id)->sum(function ($scoring) {
                return $scoring->subKriteria->nilai_sub_kriteria;
            });
            $average = $total / $alternatifs->count();
            $kriteriaAverage[$k->id] = $average;
        }

        // Calculate SP values and total SP
        $maxTotalSP = 0;
        $spTotals = [];
        foreach ($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group) {
            $spValues = [];
            foreach ($kriteria as $k) {
                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                $average = $kriteriaAverage[$k->id];
                $pdaValue = ($nilaiSubKriteria - $average) / $average;
                $pdaValue = $pdaValue < 0 ? 0 : $pdaValue;
                $spValue = $pdaValue * $k->bobot_kriteria;
                $spValues[] = $spValue;
            }
            $totalSP = array_sum($spValues);
            $spTotals[$alternatif_id] = $totalSP;
            if ($totalSP > $maxTotalSP) {
                $maxTotalSP = $totalSP;
            }
        }

        // Calculate NP values and total NP
        $maxTotalNP = 0;
        $npTotals = [];
        foreach ($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group) {
            $npValues = [];
            foreach ($kriteria as $k) {
                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                $average = $kriteriaAverage[$k->id];
                $ndaValue = ($average - $nilaiSubKriteria) / $average;
                $ndaValue = $ndaValue < 0 ? 0 : $ndaValue;
                $npValue = $ndaValue * $k->bobot_kriteria;
                $npValues[] = $npValue;
            }
            $totalNP = array_sum($npValues);
            $npTotals[$alternatif_id] = $totalNP;
            if ($totalNP > $maxTotalNP) {
                $maxTotalNP = $totalNP;
            }
        }

        // Calculate Average Score
        $averageScores = [];
        foreach ($alternatifs as $alternatif) {
            $alternatifId = $alternatif->id;
            $nsp = $spTotals[$alternatifId] / $maxTotalSP;
            $nsn = $npTotals[$alternatifId] / $maxTotalNP;
            $averageScore = ($nsp + $nsn) / 2;
            $averageScores[$alternatifId] = $averageScore;
        }

        return view('perhitungan.index', compact('scorings', 'kriteria', 'alternatifs', 'kriteriaAverage', 'spTotals', 'maxTotalSP', 'npTotals', 'maxTotalNP', 'averageScores'));
    }
    public function ranking()
    {
        // Fetch scoring data with related models
        $scorings = Scoring::with(['alternatif', 'kriteria', 'subKriteria'])->get();
        $kriteria = Kriteria::all();
        $alternatifs = Alternatif::all();

        // Calculate the average for each criteria
        $kriteriaAverage = [];
        foreach ($kriteria as $k) {
            $total = $scorings->where('kriteria_id', $k->id)->sum(function ($scoring) {
                return $scoring->subKriteria->nilai_sub_kriteria;
            });
            $average = $total / $alternatifs->count();
            $kriteriaAverage[$k->id] = $average;
        }

        // Calculate SP values and total SP
        $maxTotalSP = 0;
        $spTotals = [];
        foreach ($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group) {
            $spValues = [];
            foreach ($kriteria as $k) {
                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                $average = $kriteriaAverage[$k->id];
                $pdaValue = ($nilaiSubKriteria - $average) / $average;
                $pdaValue = $pdaValue < 0 ? 0 : $pdaValue;
                $spValue = $pdaValue * $k->bobot_kriteria;
                $spValues[] = $spValue;
            }
            $totalSP = array_sum($spValues);
            $spTotals[$alternatif_id] = $totalSP;
            if ($totalSP > $maxTotalSP) {
                $maxTotalSP = $totalSP;
            }
        }

        // Calculate NP values and total NP
        $maxTotalNP = 0;
        $npTotals = [];
        foreach ($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group) {
            $npValues = [];
            foreach ($kriteria as $k) {
                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                $average = $kriteriaAverage[$k->id];
                $ndaValue = ($average - $nilaiSubKriteria) / $average;
                $ndaValue = $ndaValue < 0 ? 0 : $ndaValue;
                $npValue = $ndaValue * $k->bobot_kriteria;
                $npValues[] = $npValue;
            }
            $totalNP = array_sum($npValues);
            $npTotals[$alternatif_id] = $totalNP;
            if ($totalNP > $maxTotalNP) {
                $maxTotalNP = $totalNP;
            }
        }

        // Calculate Average Score
        $averageScores = [];
        foreach ($alternatifs as $alternatif) {
            $alternatifId = $alternatif->id;
            $nsp = $spTotals[$alternatifId] / $maxTotalSP;
            $nsn = $npTotals[$alternatifId] / $maxTotalNP;
            $averageScore = ($nsp + $nsn) / 2;
            $averageScores[$alternatifId] = $averageScore;
        }

        arsort($averageScores);
        $rankedScores = [];
        $rank = 1;
        foreach ($averageScores as $alternatifId => $averageScore) {
            $rankedScores[] = [
                'alternatif' => $alternatifs->find($alternatifId),
                'averageScore' => $averageScore,
                'rank' => $rank++
            ];
        }

        return view('result.index', compact('scorings', 'kriteria', 'alternatifs', 'kriteriaAverage', 'spTotals', 'maxTotalSP', 'npTotals', 'maxTotalNP', 'averageScores', 'rankedScores'));
    }
}
