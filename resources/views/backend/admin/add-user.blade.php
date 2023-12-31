{{-- @extends('layouts.backend.master') --}}\
@extends('layouts.dashboard.app')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="content">
            <form action="{{url('admin/user/store')}} " method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
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
                    <label for="password-confirm">xác nhận Mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm" value="" placeholder="Xác nhận mật khẩu" >
                    @error('password')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection

