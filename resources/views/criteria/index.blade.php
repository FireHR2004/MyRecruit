@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Kriteria</h1>
    <a href="{{ route('criteria.create') }}" class="btn btn-primary">Tambah Data</a>
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
            @foreach($criteria as $criterion)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $criterion->kode_kriteria }}</td>
                <td>{{ $criterion->nama_kriteria }}</td>
                <td>{{ $criterion->bobot }}</td>
                <td>{{ $criterion->jenis }}</td>
                <td>
                    <a href="{{ route('criteria.edit', $criterion->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('criteria.destroy', $criterion->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
