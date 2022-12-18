@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/KTDonHang.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('assets/css/orders/detail.css')}}"> --}}
    <div class="content">

        <div class="noi_dung">
            
            @if (isset($title))
                <div class="container">

                    <div class="maincontent">
                        <h1>{{$title}}</h1>
                        <div class="customer-info">
                            <table>
                                <tr>
                                    <th width=20%>Thông tin khách hàng</th>
                                    <th width=80%></th>
                                </tr>
                                <tr>
                                    <td>Mã đơn hàng</td>
                                    <td>{{$orderDetail->MaDonHang}}</td>
                                </tr>
                                <tr>
                                    <td>Thông tin người đặt hàng</td>
                                    <td>{{$orderDetail->HoVaTen}}</td>
                                </tr>
                                <tr>
                                    <td>Ngày đặt hàng</td>
                                    <td>{{$orderDetail->NgayDatHang}}</td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>{{$orderDetail->SoDT}}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>{{$orderDetail->DiaChiNhanHang}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$orderDetail->Email}}</td>
                                </tr>
                                <tr>
                                    <td>Ghi chú</td>
                                    <td>{{$orderDetail->GhiChu}}</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>{{$orderDetail->TrangThai}}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="table-list">
                            <table class="user-list" border="1">
                                <thead>
                                    <tr>
                                        <th width=10%>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($productsList))
                                        @foreach ($productsList as $key => $item)

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->TenSP}}</td>
                                            <td>{{$item->Size}}</td>
                                            <td>{{$item->SoLuong}}</td>
                                            
                                            <td align="right">{{$item->GiaTien}}đ</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td colspan="4" align="right" style="color:red;"><strong>${{$orderDetail->TongTien}}</strong></td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td colspan="5">Không có sản phẩm</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            
                            @if($orderDetail->TrangThai=="Chưa giao")
                            <div class="huy">
                                <button class="btn-del">
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
                                    href="{{route('deleteUserLogin', ['id'=>$item->MaDonHang])}}">Hủy</a>
                                </button>
                            </div>
                            
                            @endif
                            
                        </div>

                        @if (session('msg'))
                        <div class="message">{{session('msg')}}</div>
                        @endif
                    </div>
                </div>
                @endif
        </div>
        
    </div>
    
@endsection
