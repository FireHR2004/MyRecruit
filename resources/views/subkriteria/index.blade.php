@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: black;">Data Sub Kriteria</h1>
        @foreach ($kriteria as $kriterium)
            <div class="card mb-3">
                <div class="card-header my-2">
                    <h5 style="color: black;">{{ $kriterium->nama_kriteria }}
                        ({{ $kriterium->kode_kriteria }})
                    </h5>
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
                            @foreach ($subKriteria->where('kriteria_id', $kriterium->id) as $subCriterion)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subCriterion->nama_sub_kriteria }}</td>
                                    <td>{{ $subCriterion->nilai_sub_kriteria }}</td>
                                    <td>
                                        <a href="{{ route('subkriteria.edit', $subCriterion->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('subkriteria.destroy', $subCriterion->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('subkriteria.create', ['kriteria_id' => $kriterium->id]) }}"
                        class="btn btn-success">Tambah Data</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
