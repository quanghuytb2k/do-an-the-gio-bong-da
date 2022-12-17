@extends('layouts.admin')
@section('content')


<div id="content" class="container-fluid">

    <div class="card">
        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>


        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" value="{{request()->input('keyword') }} " id="country_name2" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">kích hoạt <span class="text-muted">{{$count[0]}}</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary"> chưa kích hoạt <span class="text-muted">{{$count[1]}}</span></a>

            </div>
            <form action="{{url('admin/product/action')}} " method="">
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="act">
                    <option>Chọn</option>
                    @foreach ($list_act as $k => $act)

                    <option value="{{$k}} ">{{$act}}</option>

                    @endforeach

                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>

                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên điện thoại</th>

                        <th scope="col">content</th>
                        <th scope="col">thumbnail</th>
                        <th scope="col">price</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>

                    </tr>
                </thead>



                <tbody id="ajax">
                    @if ($products->total() > 0)
                    @php
                      $stt = 0;
                    @endphp
                    @foreach ($products as $item)
                    @php
                        $stt ++;
                    @endphp
                    <tr>
                        <td>
                            <input name="list_check[]" value="{{$item->id}} " type="checkbox">
                        </td>
                        <th scope="row">{{$stt}} </th>

                        <td>{{$item->name}} </td>
                        <td>{!!$item->content!!}</td>
                        <td>{{$item->thumbnail}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->created_at}} </td>

                        <td>
                            <a href="{{route('admin/edit',$item->id)}} " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(Auth::id() != $item->id)
                            <a href="{{route ('admin/product/delete', $item->id) }}" onclick="return confirm('bạn có chắc chắc xóa bản ghi này ?') " class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @else
                        <tr>
                            <th colspan="7">không tìm thấy bản ghi nào</th>
                        </tr>



                    @endif

                </tbody>



            </table>
            </form>
            {{$products->links()}}


        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

     $('#country_name2').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
      var query = $(this).val(); //lấy gía trị ng dùng gõ
      if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
      {
       var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
       $.ajax({
        url:"{{ route('searchproduct') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
        method:"POST", // phương thức gửi dữ liệu.
        data:{query:query, _token:_token},
        success:function(data){ //dữ liệu nhận về
            $('#ajax').html(data.data);
        //  $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
       }
     });
     }
   });
//    $(document).on('click', 'tr', function(){
//     $('#country_name').val($(this).text());
//   });
   });
//    function AddCart(){
//        $ajax({
//            url:'Add-cart/'+id,
//            type:"GET",
//        }).done(function(response){
//            console.log(response);
//        });
//    }
  </script>
@endsection
