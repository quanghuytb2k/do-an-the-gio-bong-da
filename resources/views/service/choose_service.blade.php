@extends('layouts.app')
<style>
    .service-card {
        background-color: #0d6efd;
        color: #fff;
        cursor: pointer;
        border-radius: 1rem;
        box-shadow: 10px 5px 5px gray;
    }

    .service-card:hover {
        background-color: #fff;
        color: #0d6efd;
        border: 1px solid #0d6efd;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h2>Chọn dịch vụ</h2>
            <div class="d-flex justify-content-around align-item-center">
                @foreach($services as $service)
                <a href="{{route('choose-service-pack', $service->id)}}">
                    <div class="d-flex flex-column p-3 m-3 service-card">
                        <h3>{{$service->name}}</h3>
                        <p class="mt-2">{{$service->description}}</p>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection