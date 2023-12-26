@extends('layouts.app')
<style>
    /* .service-card {
        background-color: #0d6efd;
        color: #fff;
        cursor: pointer;
        border-radius: 1rem;
        box-shadow: 10px 5px 5px gray;
    } */

    /* .service-card:hover {
        background-color: #fff;
        color: #0d6efd;
        border: 1px solid #0d6efd;
    } */
    .service-content{
        background: white;
        box-shadow: 5px 10px 20px gray;
        border-radius: 20px;
        height: 100% !important;
        padding: 20px;
        cursor: pointer;
    }
    .service-content .service-title {
        padding: 5px 10px;
        font-weight: 500;
        border-radius: 10px;
    }
    .service-card a, .service-card a:hover{
        text-decoration: none;
        color: #000000;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>Chọn dịch vụ</h2>
        {{-- <div class="col-lg-12">
            <div class="d-flex justify-content-around align-item-center">
                @foreach($services as $service)
                <a href="{{route('choose-service-pack', $service->id)}}">
                    <div class="d-flex flex-column p-3 m-3 service-card" style="height: 20vh;">
                        <h3>{{$service->name}}</h3>
                        <p class="mt-2">{{$service->description}}</p>
                    </div>
                </a>
                @endforeach
            </div>

        </div> --}}
    </div>
    <div class="row pt-4">
        @php
            $index = 0;
        @endphp
        @foreach($services as $service)
        @php
            $index ++;
        @endphp
        <div class="col-lg-4 service-card mt-3">
            <a href="{{route('choose-service-pack', $service->id)}}">
                <div class="service-content">
                    <span class="service-title {{ $index % 3 == 0 ? 'bg-info text-primary' : ($index % 2 == 0 ? 'bg-success' : ($index % 1 == 0 ? 'bg-warning text-danger' : ''))}}">
                        {{$service->name}}
                    </span>
                    <p class="mt-2">{{$service->description}}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
