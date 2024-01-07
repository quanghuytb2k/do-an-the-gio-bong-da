@extends('layouts.app')
<style>
    /* .service-card {
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
    .service-content .fa-check{
        font-weight: 400;
    }
    .service-content button, .service-content button:hover {
        text-align: center;
        border: none;
        outline: none;
        padding: 5px 10px;
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
        <h2>Chọn gói dịch vụ</h2>
        {{-- <div class="col-lg-12">
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
            <a href="{{route('choose-service-pack/next', $service->id)}}">
                <div class="service-content">
                    <span class="service-title {{ $index % 3 == 0 ? 'bg-info' : ($index % 2 == 0 ? 'bg-success' : ($index % 1 == 0 ? 'bg-warning text-danger' : ''))}}">
                        {{$service->name}}
                    </span>
                    <p class="mt-2">{{$service->service->description}}</p>
                    @if($service->price == 0)
                        <h3>Miễn phí</h3>
                    @else
                        <h3>{{number_format($service->price, 0, ',', '.')}} đ / tháng</h3>
                    @endif
                    <div class="py-2">
                        <i class="fa fa-check"></i> Không giới hạn tính năng
                    </div>
                    <div class="py-2">
                        <i class="fa fa-check"></i> Không phí khởi tạo
                    </div>
                    <div class="d-flex justify-content-center pt-3">
                        <button class="text-white {{ $index % 3 == 0 ? 'bg-info' : ($index % 2 == 0 ? 'bg-success' : ($index % 1 == 0 ? 'bg-warning' : ''))}}">Thanh toán</button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
