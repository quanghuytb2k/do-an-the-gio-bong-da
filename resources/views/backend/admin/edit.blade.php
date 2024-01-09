{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="header font-weight-bold">
            Cập nhật người dùng
        </div>
        <div class="content">
            <form action="{{url('admin/user/update',$user->id)}} " method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                    @error('name')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}" disabled>
                    @error('email')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm" value="" placeholder="Xác nhận mật khẩu" >
                    @error('password')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="role" name="role">
                        <option value="">Chọn quyền</option>
                        <option value="{{App\User::USER_ADMIN_ROLE}}" @if($user->role == App\User::USER_ADMIN_ROLE) selected='selected' @endif>Quản trị viên</option>
                        <option value="{{App\User::USER_CUSTOMER_ROLE}}" @if($user->role == App\User::USER_CUSTOMER_ROLE) selected='selected' @endif>Chủ sân</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thay đổi</button>
            </form>
        </div>
    </div>
</div>
@endsection

