{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
    <div class="container-fluid py-5">
        <div class="card">
            <div class="header">
                <legend>Danh sách sản phẩm</legend>
                <a href="{{route('add-product')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
            </div>
            <div class="content">
                <div class="fresh-datatables">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã sản phẩm</span></td>
                                <td><span class="thead-text">Hình ảnh</span></td>
                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                <td><span class="thead-text">Giá</span></td>
                                <td><span class="thead-text">Giá cũ</span></td>
                                <td><span class="thead-text">thương hiệu</span></td>
                                <td><span class="thead-text">size</span></td>
                                <td><span class="thead-text">số lượng</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                                <td><span class="thead-text">tác vụ</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if($product->count() >0)
                                @php
                                    $stt=0;
                                @endphp
                                @foreach($product as $item)
                                    @php
                                        $stt++
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text">{{$stt}}</h3></span>
                                        <td><span class="tbody-text">{{$item->code}}</h3></span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="{{asset($item->thumbnail)}}" alt="" style="width: 80px">
                                            </div>
                                        </td>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title="">{{$item->name}}</a>
                                            </div>

                                        </td>
                                        <td><span class="tbody-text">{{$item->price}}</span></td>
                                        <td><span class="tbody-text">{{$item->old_price}}</span></td>
                                        <td><span class="tbody-text">{{$item->trademake}}</span></td>
                                        <td><span class="tbody-text">{{$item->size}}</span></td>
                                        <td><span class="tbody-text">{{$item->amount}}</span></td>
                                        <td><span class="tbody-text">12-07-2016</span></td>
                                        <td><span class="tbody-text">
                                        <a href="{{route('edit-product', $item->id)}}" title="Sửa" class="edit">Sửa</a>/
                                        <a href="{{route('delete-product', $item->id)}}" title="Xóa" class="delete">Xóa</a></span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
        });
    </script>
@endpush
