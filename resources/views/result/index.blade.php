@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hasil Perhitungan</h1>
        <br>
        <!-- Display the Average Score table with Rank -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Average Score</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankedScores as $rankedScore)
                    <tr>
                        <td>{{ $rankedScore['alternatif']->nama_alternatif }}</td>
                        <td>{{ number_format($rankedScore['averageScore'], 2) }}</td>
                        <td>{{ $rankedScore['rank'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
