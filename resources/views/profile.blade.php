@extends('layouts.app')

@section('content')
    <div class="container profile">
        <h1 style="color: black;">Profile</h1>
        <br>
        <div class="card">
            <div class="card-body d-flex">
                <div class="mx-3">
                    <img src="{{ asset('image/userProfile.jpg') }}" class="rounded-circle" alt="Profile Picture" width="250px"
                        height="250px">
                </div>
                <div class="mx-3 w-full">
                    <h1>{{ Auth::user()->name }}</h1>
                    <h5>{{ Auth::user()->email }}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
