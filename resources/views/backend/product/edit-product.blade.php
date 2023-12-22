{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')

    <div class="container">
        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>
        @endif
        <h1>Sửa sản phẩm</h1>

        @foreach($product as $item)
            <form action="{{route('update-product',$item->id)}}" method="POST" files=true enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{$item->name}}">
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" name="code" class="form-control" value="{{$item->code}}">
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="content" class="form-control" id="desc" cols="30"
                              rows="5">{{ $item->content }} </textarea>

                    @error('content')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <img src="{{asset($item->thumbnail)}}" style="width: 80px">
                </div>
                <div class="form-group">
                    <input type="file" name="file" class="form-control-file" value="">
                </div>
                <div class="form-group">
                    <label for="">Giá sản phẩm</label>
                    <input type="text" name="price" class="form-control" value="{{$item->price}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giá cũ sản phẩm</label>
                    <input type="text" name="old_price" class="form-control" value="{{$item->old_price}}">
                </div>
                <div class="form-group">
                    <label for="">Số lượng sản phẩm</label>
                    <input type="text" name="amount" class="form-control" value="{{$item->amount}}">
                    @error('amount')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                {{--            <div class="form-group">--}}
                {{--                <label for="cat" class="font-weight-bold">Danh mục </label>--}}
                {{--                <select class="form-control" id="" name="cat">--}}
                {{--                    <option value=''>Chọn danh mục</option>--}}
                {{--                    @foreach($cats as $cat)--}}
                {{--                        <option value="{{$cat->id}}" @if($cat->id == old('cat'))--}}
                {{--                            selected='selected'--}}
                {{--                            @endif>{{str_repeat('-- ', $cat->level).' '.$cat->name}}</option>--}}
                {{--                    @endforeach--}}
                {{--                </select>--}}
                {{--                @error('cat')--}}
                {{--                <small class="text-danger">{{$message}}</small>--}}
                {{--                @enderror--}}
                {{--            </div>--}}
                <div class="form-group">
                    <label for="">Thương hiệu</label>
                    <input type="text" name="trademake" class="form-control" value="{{$item->trademake}}">
                    @error('trademake')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Xuất xứ</label>
                    <input type="text" name="origin" class="form-control" value="{{$item->origin}}">
                    @error('origin')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Kích cỡ</label>
                    <input type="text" name="size" class="form-control" value="{{$item->size}}">
                    @error('size')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">loại Giày</label>
                    <input type="text" name="type_sole" class="form-control" value="{{$item->type_sole}}">
                    @error('type_sole')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" name="sm-add" class=" btn-danger" value="Update">
                </div>
            </form>
        @endforeach
    </div>
@endsection
