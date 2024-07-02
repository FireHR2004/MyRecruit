@extends('layouts.app')
@section('content')
    <section>
        <div class="d-flex align-items-center">
            <div class="w-full p-3">
                <h1>
                    MyRecruit
                </h1>
                <br>
                <p class="fs-5 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae elit sapien. Integer pretium
                    venenatis
                    egestas. Phasellus vel tincidunt magna, ac posuere turpis. Quisque sit amet rutrum arcu, non pulvinar
                    turpis. Nam tristique pharetra nisi quis consequat. Phasellus quis egestas magna, et placerat mi.
                    Curabitur
                    eget posuere metus. Aenean placerat lorem risus, consectetur vestibulum ante ullamcorper id.
                </p>
            </div>
            <div class="m-auto p-3">
                <img class="img-fluid" src="{{ asset('image/satu.jpg') }}" alt="image" width="900">
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="text-center">
                <h1>
                    Our Team
                </h1>
            </div>
            <div class="d-flex justify-content-center pt-5">
                <div class="px-3 text-center">
                    <img src="{{ asset('image/Athiya.png') }}" alt="" width="350">
                    <h3>Ummu Athiya</h3>
                    <h6>2207411000</h6>
                </div>
                <div class="px-3 text-center">
                    <img src="{{ asset('image/Fathir.png') }}" alt="" width="350">
                    <h3>Fathir</h3>
                    <h6>2207411000</h6>
                </div>
                <div class="px-3 text-center">
                    <img src="{{ asset('image/Fathir.png') }}" alt="" width="350">
                    <h3>Bryan</h3>
                    <h6>2207411000</h6>
                </div>
            </div>
        </div>
    </section>
@endsection
