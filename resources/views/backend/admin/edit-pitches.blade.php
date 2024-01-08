{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    @if(session('status-error'))
        <div class="alert alert-warning">
            {{session('status-error')}}
        </div>
    @endif
    <div class="container">
        <h1>Sửa sân bóng</h1>
        <form action="{{route('update-pitches')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nhập tên sân bóng</label>
                        <input type="hidden" name="id_pitches" value="{{$pitches->id}}" class="form-control">
                        <input type="text" name="name_pitches" value="{{$pitches->name_pitch}}" class="form-control" placeholder='Nhập tên sân bóng'>
                        @error('name_pitches')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-col " style="width: 100%;
                        padding-right: 0;">
                        <label for="addres">Địa chỉ</label>
                        <div class="form-col " style="width: 100%;
                            padding-right: 0;">
                            <label for="province">Tỉnh/Thành Phố</label>
                            <select name="province" class="province form-control" id="province"  >
                                <option value="">-- Chọn Tỉnh/Thành Phố--</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->name}}" <?php if($pitches->province == $province->name ) echo ('selected')?>>{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-col " style="width: 100%;
                            padding-right: 0;">
                            <label for="district">Quận/Huyện</label>
                            <select name="district" class="district form-control" id="district">
                                <option value="">-- Chọn Quận/Huyện --</option>
                                @foreach($district as $dist)
                                    <option value="{{$dist->name}}" <?php if($pitches->district == $dist->name ) echo ('selected')?>>{{$dist->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-col fl-left" style="width: 100%;
                            padding-right: 0;">
                            <label for="commune">Xã/Phường</label>
                            <select name="commune" class="commune form-control">
                                <option value="">-- Chọn Xã/Phường --</option>
                                @foreach($commune as $com)
                                    <option value="{{$com->name}}" <?php if($pitches->commune == $com->name ) echo ('selected')?>>{{$com->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="images">Hình ảnh sân bóng</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên chủ sân</label>
                        <input type="text" value="{{$pitches->name}}" name="name" class="form-control" placeholder='Tên chủ sân'>
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại chủ sân</label>
                        <input type="telephone" name="telephone" value="{{$pitches->phone_number}}" class="form-control"
                               placeholder='Số điện thoại chủ sân '>
                        @error('telephone')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Miêu tả sân bóng</label>
                        <textarea name="description" class="form-control" id="description" cols="30" value="{{$pitches->description}}"
                                  rows="5">{{ old('description') }} </textarea>

                        @error('description')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <input type="submit" name="sm-add" class="btn btn-primary" value="Cập nhật">
                </div>
            </div>
        </form>
    </div>

    <script>
        $('#add-time').on('click', function () {
            var input_time = document.getElementsByName("time");
            // let add_line = input_time.length;
            // let add_line = $(this).parent().find('#time-pitches').val(); //add số dong
            // var add_line =  document.getElementById('5').getElementsByTagName('input').length;
            // console.log(add_line);
            let html = '';
            html += `
                        <hr>
                        <label for="">Giờ bắt đầu sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-start" name="time_start[]">
                        <label for="">Giờ kết thúc sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-end" name="time_end[]">
                        <label for="" style="margin-left: 110px">Gía sân</label>
                        <input class="pitches-price" type="text" id="pitches-price" name="price[]">

                    `;
            $("#pitches-price").after(html);
            // for (let i = 1; i <= add_line; i++) {
            //     html += `
            //         <input class="time-pitches" type="time" id="time-pitches" name="time[]" >
            //         `;
            // }
            // let tr = $(this).closest("#5")
            // var use_code_select = tr.find( "#time-pitches" ).attr("class");
            // console.log(use_code_select);
            // let posstion_tr_add_tr  = $("#" + use_code_select ).last().closest("#time-pitches");
            // posstion_tr_add_tr.after(html);

        });

        $("#province").change(function (){
            var _token = $('input[name="_token"]').val();
            var province = $(this).val();
            var data = {province: province, _token:_token};
            console.log(data);
            $.ajax({
                url: "{{route('district')}}",
                method: 'POST',
                data: data,
                dataType: 'json',
                success:function(data){
                    $('.district').html(data);
                    $('.commune').html(`<option value="">-- Chọn Xã/Phường --</option>`);
                    // alert(data);
                }
            });
        });
        $("#district").change(function(){
            var _token = $('input[name="_token"]').val();
            var commune = $(this).val();
            var data = {commune:commune, _token:_token};
            $.ajax({
                url:"{{route('commune')}}",
                method :'POST',
                data:data,
                dataType: 'json',
                success:function(data){
                    $('.commune').html(data);
                }
            });
        });

    </script>
    {{--    <script>--}}
    {{--        $("#district").click(function(){--}}
    {{--            var _token = $('input[name="_token"]').val();--}}
    {{--            var commune = $(this).val();--}}
    {{--            var data = {commune:commune, _token:_token};--}}
    {{--            $.ajax({--}}
    {{--                url:"{{route('commune')}}",--}}
    {{--                method :'POST',--}}
    {{--                data:data,--}}
    {{--                dataType: 'json',--}}
    {{--                success:function(data){--}}
    {{--                    $('.commune').html(data);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
