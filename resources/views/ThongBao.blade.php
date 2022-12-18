@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/ThongBao.css')}}">
    <div class="content">
        <div class="noi_dung">
            <span class="fas fa-check-circle"></span>
            <div class="NDTB">Đặt Hàng Thành Công</div>
            @if(isset($madh))
                <div class="NDTB">Mã Đơn hàng: {{$madh}}</div>
                <div class="NDTB" style="font-size: 20px">Xin vui lòng lưu lại thông tin đơn hàng này</div>
            @endif
            


        </div>
    </div>

@endsection
