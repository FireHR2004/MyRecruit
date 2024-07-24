@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Alternatif</h1>
        <br>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahModal">
            @include('icons/user-plus')
            Tambah Alternatif
        </button>
        <!-- Form Modal -->
        <div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Alternatif</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('alternatif.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_alternatif" class="form-label">Nama Alternatif</label>
                                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif"
                                    required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table View -->
        <div class="card mt-4">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5rem; text-align: center">NO</th>
                            <th scope="col">Nama Alternatif</th>
                            <th scope="col" style="width: 15rem; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($alternatif as $data_alternatif)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $data_alternatif->nama_alternatif }}</td>

                                <td style="text-align: center;">
                                    <a href="{{ route('alternatif.edit', $data_alternatif->id) }}" class="btn btn-warning">
                                        @include('icons/square-pen')
                                    </a>
                                    <form action="{{ route('alternatif.destroy', $data_alternatif->id) }}" method="POST"
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
