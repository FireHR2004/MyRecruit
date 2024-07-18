@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Sub Kriteria</h1>
    @foreach ($criteria as $criterion)
        <div class="card mb-3">
            <div class="card-header">
                <h2>{{ $criterion->nama_kriteria }} ({{ $criterion->kode_kriteria }})</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sub Kriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterion->subCriteria as $subCriterion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subCriterion->nama_sub_kriteria }}</td>
                                <td>{{ $subCriterion->nilai }}</td>
                                <td>
                                    <a href="{{ route('subcriteria.edit', $subCriterion->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('subcriteria.destroy', $subCriterion->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('subcriteria.create', ['criteria_id' => $criterion->id]) }}" class="btn btn-success">Tambah Data</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
