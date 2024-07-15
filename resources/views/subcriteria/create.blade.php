@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Sub Kriteria</h1>
    <form action="{{ route('subcriteria.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="criterion_id" class="form-label">Kriteria</label>
            <select class="form-control" id="criterion_id" name="criterion_id" required>
                @foreach ($criteria as $criterion)
                    <option value="{{ $criterion->id }}">{{ $criterion->nama_kriteria }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_sub_kriteria" class="form-label">Nama Sub Kriteria</label>
            <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" class="form-control" id="nilai" name="nilai" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
