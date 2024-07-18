@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kriteria</h1>
    <form action="{{ route('criteria.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_kriteria" class="form-label">Kode Kriteria</label>
            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" required>
        </div>
        <div class="mb-3">
            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" required>
        </div>
        <div class="mb-3">
            <label for="bobot_kriteria" class="form-label">Bobot</label>
            <input type="number" step="0.001" class="form-control" id="bobot_kriteria" name="bobot_kriteria" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kriteria" class="form-label">Jenis</label>
            <select class="form-control" id="jenis_kriteria" name="jenis_kriteria" required>
                <option value="Cost">Cost</option>
                <option value="Benefit">Benefit</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
