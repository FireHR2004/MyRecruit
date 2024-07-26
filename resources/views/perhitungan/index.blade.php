@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Perhitungan</h1>

        <!-- Title for the current table -->
        <h2>Data Awal</h2>
        <!-- Display the current table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>Score {{ $k->nama_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group)
                    <tr>
                        <td>{{ $alternatif_id }}</td>
                        <td>{{ $scoring_group->first()->alternatif->nama_alternatif }}</td>
                        @foreach($kriteria as $k)
                            <td>
                                @php
                                    $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                                    echo $scoring ? $scoring->subKriteria->nama_sub_kriteria : 'N/A';
                                @endphp
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Title for the kriteria table -->
        <h2>Daftar Kriteria</h2>
        <!-- Display the kriteria table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot Kriteria</th>
                    <th>Jenis Kriteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriteria as $k)
                    <tr>
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->kode_kriteria }}</td>
                        <td>{{ $k->nama_kriteria }}</td>
                        <td>{{ $k->bobot_kriteria }}</td>
                        <td>{{ $k->jenis_kriteria }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Title for the AV table -->
        <h2>AV</h2>
        <!-- Display the AV table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>{{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group)
                    <tr>
                        <td>{{ $scoring_group->first()->alternatif->nama_alternatif }}</td>
                        @foreach($kriteria as $k)
                            <td>
                                @php
                                    $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                                    echo $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 'N/A';
                                @endphp
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Title for the AV Sum and Average table -->
        <h2>AV Sum and Average</h2>
        <!-- Display the AV Sum and Average table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    @foreach($kriteria as $k)
                        <th>{{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $kriteriaSum = [];
                    $kriteriaAverage = [];
                    $totalAlternatif = $scorings->groupBy('alternatif_id')->count();
                @endphp
                <tr>
                    <td>Sum</td>
                    @foreach($kriteria as $k)
                        @php
                            $sum = $scorings->where('kriteria_id', $k->id)->sum('subKriteria.nilai_sub_kriteria');
                            $kriteriaSum[$k->id] = $sum;
                        @endphp
                        <td>{{ $sum }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Average</td>
                    @foreach($kriteria as $k)
                        @php
                            $average = $kriteriaSum[$k->id] / $totalAlternatif;
                            $kriteriaAverage[$k->id] = $average;
                        @endphp
                        <td>{{ number_format($average, 2) }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>

        <!-- Title for the PDA table -->
        <h2>PDA</h2>
        <!-- Display the PDA table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>{{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group)
                    <tr>
                        <td>{{ $scoring_group->first()->alternatif->nama_alternatif }}</td>
                        @foreach($kriteria as $k)
                            <td>
                                @php
                                    $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                                    $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                                    $average = $kriteriaAverage[$k->id];
                                    $pdaValue = ($nilaiSubKriteria - $average) / $average;
                                    $pdaValue = $pdaValue < 0 ? 0 : $pdaValue;
                                @endphp
                                {{ number_format($pdaValue, 2) }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Title for the NDA table -->
        <h2>NDA</h2>
        <!-- Display the NDA table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>{{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group)
                    <tr>
                        <td>{{ $scoring_group->first()->alternatif->nama_alternatif }}</td>
                        @foreach($kriteria as $k)
                            <td>
                                @php
                                    $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                                    $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                                    $average = $kriteriaAverage[$k->id];
                                    $ndaValue = ($average - $nilaiSubKriteria) / $average;
                                    $ndaValue = $ndaValue < 0 ? 0 : $ndaValue;
                                @endphp
                                {{ number_format($ndaValue, 2) }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Title for the SP table -->
<h2>SP</h2>
<!-- Display the SP table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($kriteria as $index => $k)
                <th>C{{ $index + 1 }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $maxTotalSP = 0;
            $spTotals = [];
        @endphp
        @foreach($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group)
            @php
                $spValues = [];
                foreach($kriteria as $k) {
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
            @endphp
            <tr>
                <td>{{ $alternatifs->find($alternatif_id)->nama_alternatif }}</td>
                @foreach($spValues as $spValue)
                    <td>{{ number_format($spValue, 2) }}</td>
                @endforeach
                <td>{{ number_format($totalSP, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Title for the NSP table -->
<h2>NSP</h2>
<!-- Display the NSP table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Alternatif</th>
            <th>NSP Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($spTotals as $alternatif_id => $totalSP)
            @php
                $nspValue = $totalSP / $maxTotalSP;
            @endphp
            <tr>
                <td>{{ $alternatifs->find($alternatif_id)->nama_alternatif }}</td>
                <td>{{ number_format($nspValue, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



        <!-- Title for the NP table -->
        <h2>NP</h2>
        <!-- Display the NP table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>{{ $k->kode_kriteria }}</th>
                    @endforeach
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scorings->groupBy('alternatif_id') as $alternatif_id => $scoring_group)
                    <tr>
                        <td>{{ $scoring_group->first()->alternatif->nama_alternatif }}</td>
                        @php
                            $npValues = [];
                        @endphp
                        @foreach($kriteria as $k)
                            @php
                                $scoring = $scoring_group->where('kriteria_id', $k->id)->first();
                                $nilaiSubKriteria = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                                $average = $kriteriaAverage[$k->id];
                                $ndaValue = ($average - $nilaiSubKriteria) / $average;
                                $ndaValue = $ndaValue < 0 ? 0 : $ndaValue;
                                $npValue = $ndaValue * $k->bobot_kriteria;
                                $npValues[] = $npValue;
                            @endphp
                            <td>{{ number_format($npValue, 2) }}</td>
                        @endforeach
                        @php
                            $totalNP = array_sum($npValues);
                        @endphp
                        <td><strong>{{ number_format($totalNP, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
@endsection
