@extends('layouts.app')

@section('content')
    <div class="container profile">
        <h1 style="color: black;">Profile</h1>
        <br>
        <div class="card">
            <div class="card-body">
                <h4>{{ Auth::user()->name }}</h4>
                <h5>{{ Auth::user()->email }}</h5>
            </div>
        </div>
    </div>
@endsection
