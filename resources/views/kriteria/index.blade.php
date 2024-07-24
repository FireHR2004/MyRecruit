@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Kriteria</h1>
        <br>
        <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Tambah Kriteria</a>
        <div class="card mt-4">
            <div class="card-body">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $data_kriteria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data_kriteria->kode_kriteria }}</td>
                                <td>{{ $data_kriteria->nama_kriteria }}</td>
                                <td>{{ $data_kriteria->bobot_kriteria }}</td>
                                <td>{{ $data_kriteria->jenis_kriteria }}</td>
                                <td>
                                    <a href="{{ route('kriteria.edit', $data_kriteria->id) }}"
                                        class="btn btn-warning">@include('icons/square-pen')</a>
                                    <form action="{{ route('kriteria.destroy', $data_kriteria->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">@include('icons/trash')</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
