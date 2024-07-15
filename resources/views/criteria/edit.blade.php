@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kriteria</h1>
    <form action="{{ route('criteria.update', $criterion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_kriteria" class="form-label">Kode Kriteria</label>
            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" value="{{ $criterion->kode_kriteria }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="{{ $criterion->nama_kriteria }}" required>
        </div>
        <div class="mb-3">
            <label for="bobot" class="form-label">Bobot</label>
            <input type="number" step="0.001" class="form-control" id="bobot" name="bobot" value="{{ $criterion->bobot }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-control" id="jenis" name="jenis" required>
                <option value="Cost" {{ $criterion->jenis == 'Cost' ? 'selected' : '' }}>Cost</option>
                <option value="Benefit" {{ $criterion->jenis == 'Benefit' ? 'selected' : '' }}>Benefit</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
