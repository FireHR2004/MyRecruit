@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hasil Perhitungan</h1>
        <br>

        <h2>Average Score</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Akhir</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rankings as $alternatif_id => $rank)
                    <tr>
                        <td>{{ $scorings->where('alternatif_id', $alternatif_id)->first()->alternatif->nama_alternatif }}</td>
                        <td>{{ number_format($as[$alternatif_id], 2) }}</td>
                        <td>{{ $rank }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
