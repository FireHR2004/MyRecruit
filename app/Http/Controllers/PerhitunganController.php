<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scoring;
use App\Models\Kriteria;

class PerhitunganController extends Controller
{
    public function index()
    {
        $scorings = Scoring::with(['alternatif', 'kriteria', 'subKriteria'])->get();
        $kriteria = Kriteria::all();

        // Calculate averages for each kriteria
        $averages = [];
        foreach ($kriteria as $k) {
            $total = $scorings->where('kriteria_id', $k->id)
                ->sum(function ($scoring) {
                    return $scoring->subKriteria->nilai_sub_kriteria * $scoring->kriteria->bobot_kriteria;
                });
            $count = $scorings->where('kriteria_id', $k->id)->count();
            $averages[$k->id] = $count ? $total / $count : 0;
        }

        // Calculate PDA, NDA, SP, and SN
        $pdaNda = [];
        $spSn = [];
        foreach ($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group) {
            $pda = [];
            $nda = [];
            $sp = 0;
            $sn = 0;

            foreach ($kriteria as $k) {
                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                $nilai = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                $bobot = $k->bobot_kriteria;
                $average = $averages[$k->id] ?? 0;

                $nilai_bobot = $nilai * $bobot;

                if ($average > 0) {
                    if ($k->jenis_kriteria == 'Benefit') {
                        $pda[$k->id] = max(0, ($nilai_bobot - $average)) / $average;
                        $nda[$k->id] = max(0, ($average - $nilai_bobot)) / $average;
                    } else { // Cost
                        $pda[$k->id] = max(0, ($average - $nilai_bobot)) / $average;
                        $nda[$k->id] = max(0, ($nilai_bobot - $average)) / $average;
                    }
                } else {
                    $pda[$k->id] = 0;
                    $nda[$k->id] = 0;
                }

                // Sum up SP and SN
                $sp += $pda[$k->id];
                $sn += $nda[$k->id];
            }

            $pdaNda[$alternatif_id] = ['pda' => $pda, 'nda' => $nda];
            $spSn[$alternatif_id] = ['sp' => $sp, 'sn' => $sn];
        }

        // Calculate NSP and NSN for each alternative
        $maxSN = max(array_column($spSn, 'sn'));

        $nsp = [];
        $nsn = [];
        $as = []; // Array to hold Average Score (AS) values

        foreach ($spSn as $alternatif_id => $values) {
            $sp = $values['sp'];
            $sn = $values['sn'];

            $totalWeight = array_sum(array_column($kriteria->toArray(), 'bobot_kriteria'));

            $nsp[$alternatif_id] = $totalWeight ? $sp / $totalWeight : 0;
            $nsn[$alternatif_id] = $maxSN > 0 ? 1 - ($sn / $maxSN) : 0;

            // Calculate AS and ensure it is between 0 and 1
            $as[$alternatif_id] = max(0, min(1, 0.5 * ($nsp[$alternatif_id] + $nsn[$alternatif_id])));
        }

        return view('perhitungan.index', [
            'scorings' => $scorings,
            'kriteria' => $kriteria,
            'averages' => $averages,
            'pdaNda' => $pdaNda,
            'spSn' => $spSn,
            'nsp' => $nsp,
            'nsn' => $nsn,
            'as' => $as
        ]);
    
    }

    public function ranking()
    {
        $scorings = Scoring::with(['alternatif', 'kriteria', 'subKriteria'])->get();
        $kriteria = Kriteria::all();

        // Calculate averages for each kriteria
        $averages = [];
        foreach ($kriteria as $k) {
            $total = $scorings->where('kriteria_id', $k->id)
                ->sum(function ($scoring) {
                    return $scoring->subKriteria->nilai_sub_kriteria * $scoring->kriteria->bobot_kriteria;
                });
            $count = $scorings->where('kriteria_id', $k->id)->count();
            $averages[$k->id] = $count ? $total / $count : 0;
        }

        // Calculate PDA, NDA, SP, and SN
        $pdaNda = [];
        $spSn = [];
        foreach ($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group) {
            $pda = [];
            $nda = [];
            $sp = 0;
            $sn = 0;

            foreach ($kriteria as $k) {
                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                $nilai = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                $bobot = $k->bobot_kriteria;
                $average = $averages[$k->id] ?? 0;

                $nilai_bobot = $nilai * $bobot;

                if ($average > 0) {
                    if ($k->jenis_kriteria == 'Benefit') {
                        $pda[$k->id] = max(0, ($nilai_bobot - $average)) / $average;
                        $nda[$k->id] = max(0, ($average - $nilai_bobot)) / $average;
                    } else { // Cost
                        $pda[$k->id] = max(0, ($average - $nilai_bobot)) / $average;
                        $nda[$k->id] = max(0, ($nilai_bobot - $average)) / $average;
                    }
                } else {
                    $pda[$k->id] = 0;
                    $nda[$k->id] = 0;
                }

                // Sum up SP and SN
                $sp += $pda[$k->id];
                $sn += $nda[$k->id];
            }

            $pdaNda[$alternatif_id] = ['pda' => $pda, 'nda' => $nda];
            $spSn[$alternatif_id] = ['sp' => $sp, 'sn' => $sn];
        }

        // Calculate NSP and NSN for each alternative
        $maxSN = max(array_column($spSn, 'sn'));

        $nsp = [];
        $nsn = [];
        $as = []; // Array to hold Average Score (AS) values

        foreach ($spSn as $alternatif_id => $values) {
            $sp = $values['sp'];
            $sn = $values['sn'];

            $totalWeight = array_sum(array_column($kriteria->toArray(), 'bobot_kriteria'));

            $nsp[$alternatif_id] = $totalWeight ? $sp / $totalWeight : 0;
            $nsn[$alternatif_id] = $maxSN > 0 ? 1 - ($sn / $maxSN) : 0;

            // Calculate AS and ensure it is between 0 and 1
            $as[$alternatif_id] = max(0, min(1, 0.5 * ($nsp[$alternatif_id] + $nsn[$alternatif_id])));
        }

        // Sort alternatives by AS and rank them
        $rankedAlternatives = collect($as)->sortDesc()->values()->all();
        $rankings = [];
        foreach ($rankedAlternatives as $key => $value) {
            $rankings[array_search($value, $as)] = $key + 1; // Rank starts at 1
        }

        return view('result.index', [
            'scorings' => $scorings,
            'kriteria' => $kriteria,
            'as' => $as,
            'rankings' => $rankings
        ]);
    }

}
