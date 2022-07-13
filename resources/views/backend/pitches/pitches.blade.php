@extends('layouts.backend.master')
@section('content')

    <div class="container">
        <h1>Thêm sân bóng</h1>
        <form action="{{route('store-pitches')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nhập tên sân bóng</label>
                        <input type="text" name="name_pitches" class="form-control" placeholder='Nhập tên sân bóng'>
                        @error('name_pitches')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Nhập địa chỉ</label>
                        <input type="text" name="address" class="form-control" placeholder='Nhập địa chỉ'>
                        @error('address')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="images">Hình ảnh sân bóng</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="description">Miêu tả sân bóng</label>
                        <textarea name="description" class="form-control" id="description" cols="30"
                                  rows="5">{{ old('description') }} </textarea>

                        @error('description')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="price">Gía sân</label>--}}
{{--                        <input type="text" name="price" class="form-control" placeholder='giá sân bóng'>--}}
{{--                        @error('price')--}}
{{--                        <small class="form-text text-danger">{{$message}}</small>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên chủ sân</label>
                        <input type="text" name="name" class="form-control" placeholder='Tên chủ sân'>
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại chủ sân</label>
                        <input type="telephone" name="telephone" class="form-control"
                               placeholder='Số điện thoại chủ sân '>
                        @error('telephone')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group booking-date" id="5">
                        <label for="">Khung giờ đá của sân</label><br>
                        <label for="start">Ngày chọn sân</label>
                        <input type="date" id="start" multiple="multiple" name="date"><br><br>
                        <label for="">Giờ bắt đầu sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-start" name="time_start[]">
                        <label for="">Giờ kết thúc sân đá</label>
                        <input class="time-pitches" type="time" id="time-pitches-end" name="time_end[]">
                        <label for="" style="margin-left: 160px">Gía sân</label>
                        <input class="pitches-price" type="text" id="pitches-price" name="price[]">
                        <hr>
                        <p id="add-time"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" name="sm-add" class="fbtn btn-danger" value="Thêm mới">
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
