@extends('layouts.backend.master')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách mã khuyến mãi</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" class="form-control form-search"  name="country_name" id="country_name" placeholder="Tìm kiếm">
                    {{-- <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary"> --}}
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('admin/user/action')}} " method="">
            <table class="table table-striped table-checkall  " id="countryList">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên mã khuyến mãi</th>
                        <th scope="col">Mã khuyến mãi</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Số tiền hoặc số % giảm</th>
                        <th scope="col">Loại tính năng khuyến mãi</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian kết thúc</th>
                    </tr>
                </thead>
                <tbody class="ajax" id="ajax">
                    @if ($coupon->count() > 0)
                        @php
                            $stt = 0;
                        @endphp
                        @foreach ($coupon as $item)
                        @php
                        $stt ++;
                        @endphp
                        <div >
                        <tr >
                        <td>
                            <input name="list_check[]" value="{{$item->id}} " type="checkbox">
                        </td>
                        <th scope="row">{{$stt}} </th>
                        <td id="name">{{$item->name}} </td>
                        <td>{{$item->code}} </td>
                        <td>{{$item->quantily}} </td>
                        <td> <?php if ($item->condition == 1) echo $item->feature."%"; else echo $item->feature."k"; ?> </td>
                        <td> <?php if ($item->condition == 1) echo "Giảm giá theo phần trăm"; else echo"Giảm giá theo tiền mặt" ; ?></td>
                        <td>{{$item->time_start}} </td>
                        <td>{{$item->time_end}} </td>
                        </tr>
                        </div>
                        @endforeach

                    @else
                        <tr>
                            <th colspan="7">không tìm thấy bản ghi nào</th>
                        </tr>
                    @endif

                </tbody>
            </table>
            </form>
            {{$coupon->links()}}


        </div>
    </div>
</div>
<script type="text/javascript">
//     $(document).ready(function(){

//      $('#country_name').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
//       var query = $(this).val(); //lấy gía trị ng dùng gõ
//       if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
//       {
//        var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
//        $.ajax({
//         url:"{{ route('search') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
//         method:"POST", // phương thức gửi dữ liệu.
//         data:{query:query, _token:_token},
//         success:function(data){ //dữ liệu nhận về
//             $('#ajax').html(data.data);
//         //  $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
//        }
//      });
//      }
//    });
//    $('#ajax tr').click(function(){
//        console.log('helo');
//        $('#country_name').val($(this).text());

//    })
//    $(document).on('click', 'tr', function(){
//     $('#country_name').val($(this).closest('tr').find('td:nth-child(3)').text());
//   });
//    });
// //////////////////////////////////
//    $(function(){
//  $(document).on('click','#remove_item', function () {
//       var id = $('#remove_item').data('id');
//       console.log(id);
//       $.ajax({
//              type: 'DELETE',
//              url: 'admin/user/delete/'+ id,
//              data: {'_token': $('input[name=_token]').val()},
//              success: function (data) {

//              }
//         });
//        });
//      });
//   </script>
@endsection
