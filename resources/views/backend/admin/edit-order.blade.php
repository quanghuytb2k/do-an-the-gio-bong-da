@extends('layouts.backend.master')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật đơn hàng
        </div>
        <div class="card-body">
            <form action='{{route('admin-store-pitches', $order->id)}}' method="POST" files = true enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name_customer">Tên khách hàng</label>
                            <input class="form-control" type="text" name="name_customer" id="code" value="{{$order->name_customer}}" >
                            @error('name_customer')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="email">email</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{$order->email}}" >
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{$order->phone}}">
                            @error('phone')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="note">Note</label>
                            <input class="form-control" type="text" name="note" id="note" value="{{$order->note}}">
                            @error('note')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="btn-update" value="Cập nhật">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@endsection
