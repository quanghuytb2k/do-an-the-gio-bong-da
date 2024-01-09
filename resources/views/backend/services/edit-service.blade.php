{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="header font-weight-bold">
            Cập nhật dịch vụ
        </div>
        <div class="content">
            <form action="{{url('admin/services/update',$service->id)}} " method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên dịch vụ</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$service->name}}">
                    @error('name')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <input class="form-control" type="text" name="description" id="description" value="{{$service->description}}">
                    @error('description')
                        <small class="text-danger">{{$message}} </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection

