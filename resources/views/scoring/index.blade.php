@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Scoring</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $alternatif)
                <tr>
                    <td>{{ $alternatif->id }}</td>
                    <td>{{ $alternatif->nama_alternatif }}</td>
                    <td>
                        <a href="{{ route('scoring.edit', $alternatif->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
