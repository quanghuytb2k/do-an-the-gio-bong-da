{{-- @extends('layouts.backend.master') --}}
@extends('layouts.dashboard.app')
@section('content')
<div class="app" style="margin: 10% 30% ; border: 1px solid blue">
    <form action="{{route('store')}}" method="POST">
        @csrf
        <label for="">name</label>
        <input type="text" name="name"><br>
        <label for="Gía tiền">Gía tiền</label>
        <input type="text" name="price"><br>
        <input class="btn btn-yellow" type="submit" value="Đặt sân" style="background-color: yellow; ">
    </form>

</div>
@endsection
