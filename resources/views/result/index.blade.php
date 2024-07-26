@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hasil Perhitungan</h1>
        <br>
        <!-- Display the Average Score table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Average Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($averageScores as $alternatif_id => $averageScore)
                    <tr>
                        <td>{{ $alternatifs->find($alternatif_id)->nama_alternatif }}</td>
                        <td>{{ number_format($averageScore, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
