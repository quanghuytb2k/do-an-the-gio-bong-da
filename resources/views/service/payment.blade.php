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
            <h2>Thông tin tài khoản</h2>
            <form method="POST" action="{{ route('choose-service-pack/payment') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Tên tài khoản</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter name" required name="name" autocomplete="off">
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email" required name="email" autocomplete="off">
                    @error('email')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                    @error('password')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm password</label>
                    <input type="password" class="form-control" id="password-confirm" placeholder="Enter confirm password" name="password_confirmation" required autocomplete="off">
                </div>
                <div class="form-group row d-none">
                    <input id="servicePackId" type="number" name="service_id" value="{{ $service->id }}">
                </div>
                @if($service->price > 0)
                <div class="mt-5">
                    <h2>Thanh toán để hoàn thành tạo tài khoản</h2>
                    <h4>Hình thức thanh toán</h4>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment" value="1" checked>
                                <label for="direct-payment">Thanh toán trực tiếp tại sân</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment" value="2">
                                <label for="payment-home">Thanh toán qua momo</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment" value="3">
                                <label for="payment-home">Thanh toán qua vnpay</label>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
@endsection
