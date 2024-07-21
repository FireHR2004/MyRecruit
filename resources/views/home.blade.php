@extends('layouts.app')

@section('content')
    <div class="d-flex gap-5">
        <a href="/kriteria" style="text-decoration: none;">
            <div class="card" style="width: 300px;">
                <div class="card-body d-flex gap-3" style="align-items: center">
                    <img src="{{ asset('image/box.svg') }}" alt="" style="width: 50px">
                    <h2>Kriteria</h2>
                </div>
            </div>
        </a>
        <a href="/subkriteria" style="text-decoration: none;">
            <div class="card" style="width: 300px;">
                <div class="card-body d-flex gap-3" style="align-items: center">
                    <img src="{{ asset('image/boxes.svg') }}" alt="" style="width: 50px">
                    <h2>Sub Kriteria</h2>
                </div>
            </div>
        </a>
        <a href="/alternatif" style="text-decoration: none;">
            <div class="card" style="width: 300px;">
                <div class="card-body d-flex gap-3" style="align-items: center">
                    <img src="{{ asset('image/users-round.svg') }}" alt="" style="width: 50px">
                    <h2>Alternatif</h2>
                </div>
            </div>
        </a>
        <a href="/hasil" style="text-decoration: none;">
            <div class="card" style="width: 300px;">
                <div class="card-body d-flex gap-3" style="align-items: center">
                    <img src="{{ asset('image/bar-chart-big.svg') }}" alt="" style="width: 50px">
                    <h2>Hasil</h2>
                </div>
            </div>
        </a>
    </div>
@endsection
