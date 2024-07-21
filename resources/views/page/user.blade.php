@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered border-black">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row" class="text-center">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->password }}</td>
                                <td>
                                    <center>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#"
                                            method="POST">
                                            <a href="#"
                                                class="btn btn-sm btn-primary">@include('icons/square-pen')</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger">@include('icons/trash')</button>
                                        </form>
                                    </center>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger">
                                        Data Post belum Tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
