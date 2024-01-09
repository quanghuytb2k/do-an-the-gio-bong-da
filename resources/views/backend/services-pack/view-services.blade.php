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
            <h5 class="m-0 ">Danh sách gói dịch vụ</h5>
        </div>
        <div class="content">
            <div class="fresh-datatables">
                <table class="table table-striped table-checkall" id="countryList">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Tên gói</th>
                            <th scope="col">Loại gói</th>
                            <th scope="col">Tên dịch vụ</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody class="ajax" id="ajax">
                        @foreach ($servicePacks as $pack)
                            <div>
                                <tr>
                                    <td></td>
                                    <td>{{$pack->name}}</td>
                                    <td>{{$pack->unitName}} </td>
                                    <td>{{$pack->service ? $pack->service->name : null}} </td>
                                    <td>{{$pack->price ? number_format($pack->price, 0, ',', '.') : null}} </td>
                                    <td>
                                        <a href="{{route('admin/services-pack/edit-service',$pack->id)}} " class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" id="remove_item" onclick="remove({{$pack->id}})" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Remove">
                                            <i class="fa fa-trash"></i>
                                        </a>
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

        function remove(id){
            $.ajax({
                url: 'admin/services-pack/delete',
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                },
                success: function (data) {
                    if(data.code == 200){
                        alertSuccess("");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }else{
                        let message = data.message ? data.message : null;
                        alertError(message);
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
