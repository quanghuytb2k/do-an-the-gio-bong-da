@extends('layouts.app')
<style>
    .service-card {
        background-color: #fff;
        color: #0d6efd;
        border: 1px solid #0d6efd;
        cursor: pointer;
        border-radius: 1rem;
        box-shadow: 10px 5px 5px gray;
        text-decoration: none;
    }

    .service-card:hover {
        background-color: #0d6efd;
        color: #fff;
        text-decoration: none;
    }

    h3{
        text-decoration: none !important;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h2>Chọn gói dịch vụ</h2>
            <div class="d-flex justify-content-around align-item-center">
                @foreach($services as $service)
                <a href="{{route('choose-service-pack/next', $service->id)}}">
                    <div class="d-flex flex-column p-3 m-3 service-card">
                        <h3>{{$service->name}}</h3>
                        <p class="mt-2">{{$service->service->name}}</p>
                        <p class="mt-2">{{$service->service->description}}</p>
                        @if($service->price == 0)
                        <h3>Miễn phí</h3>
                        @else
                        <h3>@convert($service->price)</h3>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection