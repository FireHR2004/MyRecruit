@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Perhitungan</h1>
        <br>

        <h2>Data Awal</h2>
        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 100px;">No</th>
                    <th style="width: 200px;">Alternatif</th>
                    @foreach($kriteria as $k)
                        <th style="width: 150px;">Score {{ $k->nama_kriteria }}</th>
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

        <h2>Data Score</h2>
        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 100px;">No</th>
                    <th style="width: 200px;">Alternatif</th>
                    @foreach($kriteria as $k)
                        <th style="width: 150px;">Score {{ $k->nama_kriteria }}</th>
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
                                    echo $scoring && $scoring->subKriteria ? $scoring->subKriteria->nilai_sub_kriteria : 'N/A';
                                @endphp
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Daftar Bobot</h2>
        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th style="width: 150px;">Kode Kriteria</th>
                    <th style="width: 250px;">Nama Kriteria</th>
                    <th style="width: 150px;">Bobot Kriteria</th>
                    <th style="width: 150px;">Jenis Kriteria</th>
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

        <h2>Average Solution</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>{{ $k->kode_kriteria }}</th>
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
                                    $nilai = $scoring ? $scoring->subKriteria->nilai_sub_kriteria : 0;
                                    $bobot = $k->bobot_kriteria;
                                    $average = $nilai * $bobot;
                                    echo number_format($average, 2);
                                @endphp
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>PDA</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    @foreach($kriteria as $k)
                        <th>PDA {{ $k->kode_kriteria }}</th>
                        <!-- <th>NDA {{ $k->kode_kriteria }}</th> -->
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($pdaNda as $alternatif_id => $values)
                    <tr>
                        <td>{{ $alternatif_id }}</td>
                        <td>{{ $scorings->where('alternatif_id', $alternatif_id)->first()->alternatif->nama_alternatif }}</td>
                        @foreach($kriteria as $k)
                            <td>{{ number_format($values['pda'][$k->id] ?? 0, 2) }}</td>
                            <!-- <td>{{ number_format($values['nda'][$k->id] ?? 0, 2) }}</td> -->
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>NDA</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <!-- <th>PDA {{ $k->kode_kriteria }}</th> -->
                    @foreach($kriteria as $k)
                        <th>NDA {{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($pdaNda as $alternatif_id => $values)
                    <tr>
                        <td>{{ $alternatif_id }}</td>
                        <td>{{ $scorings->where('alternatif_id', $alternatif_id)->first()->alternatif->nama_alternatif }}</td>
                        @foreach($kriteria as $k)
                            <!-- <td>{{ number_format($values['pda'][$k->id] ?? 0, 2) }}</td> -->
                            <td>{{ number_format($values['nda'][$k->id] ?? 0, 2) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>NSP and NSN</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>NSP</th>
                    <th>NSN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nsp as $alternatif_id => $value)
                    <tr>
                        <td>{{ $scorings->where('alternatif_id', $alternatif_id)->first()->alternatif->nama_alternatif }}</td>
                        <td>{{ number_format($value, 2) }}</td>
                        <td>{{ number_format($nsn[$alternatif_id] ?? 0, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <h2>AS (Average Score)</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>AS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($as as $alternatif_id => $value)
                    <tr>
                        <td>{{ $scorings->where('alternatif_id', $alternatif_id)->first()->alternatif->nama_alternatif }}</td>
                        <td>{{ number_format($value, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
