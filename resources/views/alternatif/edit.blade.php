@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Alternatif</h1>
        <br>
        <!-- Table View -->
        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_alternatif" class="form-label">Nama
                            Alternatif</label>
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/alternatif" type="submit" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
