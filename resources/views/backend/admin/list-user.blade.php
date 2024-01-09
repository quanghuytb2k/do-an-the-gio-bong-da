{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <div class="header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
        </div>
        <div class="content">
            <div class="fresh-datatables">
                <table class="table table-striped table-checkall" id="countryList">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="ajax" id="ajax">
                        @foreach ($users as $item)
                            <div>
                                <tr>
                                    <td></td>
                                    <td id="name">{{$item->name}} </td>
                                    <td>{{$item->email}} </td>
                                    <td>
                                        @if($item->role == App\User::USER_ADMIN_ROLE)
                                            Quản trị viên
                                        @else
                                            Chủ sân
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}} </td>

                                    <td>
                                        <a href="{{route('admin/edit',$item->id)}} " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        @if(Auth::id() != $item->id)
                                            <a href="javascript:void(0)" id="remove_item" onclick="remove({{$item->id}})" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Tất cả"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Tìm kiếm",
                }

            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        });

        $(document).ready(function(){
            $('#country_name').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
                var query = $(this).val(); //lấy gía trị ng dùng gõ
                if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
                {
                    var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                    $.ajax({
                        url:"{{ route('search') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                        method:"POST", // phương thức gửi dữ liệu.
                        data:{query:query, _token:_token},
                        success:function(data){ //dữ liệu nhận về
                            $('#ajax').html(data.data);
                        //  $('#countryList').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                        }
                    });
                }
            });
            //    $('#ajax tr').click(function(){
            //        console.log('helo');
            //        $('#country_name').val($(this).text());

            //    })
            $(document).on('click', 'tr', function(){
                $('#country_name').val($(this).closest('tr').find('td:nth-child(3)').text());
            });
        });

        function remove(id){
            $.ajax({
                url: 'admin/user/delete',
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                },
                success: function (data) {
                    if(data == 200){
                        alertSuccess("");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }else{
                        alertError("");
                    }
                }
            });
        }

        function alertSuccess(message) {
            swal("Thành công", message, "success");
        }

        function alertError(message){
            swal("Đã xảy ra lỗi!", message, "warning");
        }
    </script>
@endpush
