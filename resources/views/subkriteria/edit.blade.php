@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Sub Kriteria</h1>
        <form action="{{ route('subkriteria.update', $subkriterium->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kriteria_id" class="form-label">Kriteria</label>
                <select class="form-control" id="kriteria_id" name="kriteria_id" required>
                    @foreach ($kriteria as $kriterium)
                        <option value="{{ $kriterium->id }}"
                            {{ $kriterium->id == $subkriterium->kriteria_id ? 'selected' : '' }}>
                            {{ $kriterium->nama_kriteria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_sub_kriteria" class="form-label">Nama Sub Kriteria</label>
                <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria"
                    value="{{ $subkriterium->nama_sub_kriteria }}" required>
            </div>
            <div class="mb-3">
                <label for="nilai_sub_kriteria" class="form-label">Nilai</label>
                <input type="number" class="form-control" id="nilai_sub_kriteria" name="nilai_sub_kriteria"
                    value="{{ $subkriterium->nilai_sub_kriteria }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
