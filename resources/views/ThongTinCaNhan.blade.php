
@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/ThongTinCaNhan.css')}}">
    <section>
        <div class="ChucNang">
            <a href="{{route('ThongTinCaNhan.index')}}" class="CTCN">
                <div class="t">Thông tin cá nhân</div> 
            </a>
            <a href="{{route('KTDHview')}}" class="CTCN">
                <div class="t">Đơn hàng của bạn</div> 
            </a>
            <a href="{{route('XepHangThanhVien')}}" class="CTCN">
                <div class="t">Hạng thành viên</div> 
            </a>
        </div>
    @if(isset($TTTK))
    <div class="ThongTinCaNhan1" style="padding-bottom: 40px">
        @if($TTTK->TieuDung >= 20000000)
        <div class="table-list1">
            <div class="xephang">Xếp Hạng: hạng Kim Cương</div>
            {{-- {{$TTTK->TieuDung}}/20tr --}}
            <div class="canmua">số tiền tiêu dùng của bạn: {{$TTTK->TieuDung}}</div>
        </div>
        @elseif($TTTK->TieuDung >= 10000000)
        <div class="table-list1">
            <div class="xephang">Xếp Hạng: hạng Vàng</div>
            <div class="tttieudung">Tiêu dùng: {{$TTTK->TieuDung}}/20tr</div>
            <div class="canmua">Cần mua thêm {{20000000 - $TTTK->TieuDung}}</div>
        </div>
        {{-- @elseif() --}}
        @elseif($TTTK->TieuDung >= 3000000)
        <div class="table-list1">
            <div class="xephang">Xếp Hạng: hạng bạc</div>
            <div class="tttieudung">Tiêu dùng: {{$TTTK->TieuDung}}/10tr</div>
            <div class="canmua">Cần mua thêm {{10000000 - $TTTK->TieuDung}} để đạt hạng vàng</div>
        </div>
        @else
            <div class="table-list1">
                <div class="xephang">Xếp Hạng: hạng Thành viên</div>
                <div class="tttieudung">Tiêu dùng: {{$TTTK->TieuDung}}/3tr</div>
                <div class="canmua">Cần mua thêm {{3000000 - $TTTK->TieuDung}} để đạt hạng bạc</div>
            </div> 
        @endif
        
        <table style="text-align: left; font-size: 25px; margin-top:25px; background-color: rgb(243, 188, 188); width: 60%;border-radius: 5px; height: 40%">
            {{-- <caption></caption> --}}
            <tr>
                <td colspan="2" style="text-align: center">Thưởng hạng</td>
            </tr>
            <tr>
                <td>Hạng thành viên</td>
                <td>Không có</td>
            </tr>
            <tr>
                <td>Hạng bạc</td>
                <td>giảm 2%/đơn</td>
            </tr>
            <tr>
                <td>Hạng vàng</td>
                <td>giảm 4%/đơn</td>
            </tr>
            <tr>
                <td>Hạng kim cương</td>
                <td>giảm 5%/đơn</td>
            </tr>
            
        </table>
        
    </div>
    @elseif(isset($ordersList))
    <div class="ThongTinCaNhan" style="padding-bottom: 40px">
        <h1 style="text-align: center; padding: 10px">Đơn hàng của bạn</h1>
        <div class="table-list">
            <table class="user-list" border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Địa chỉ Nhận</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($ordersList))
                        @foreach ($ordersList as $key => $item)
                    <tr>
                        <td>{{$item->MaDonHang}}</td>
                        <td>{{$item->DiaChiNhanHang}}</td>
                        <td>{{$item->NgayDatHang}}</td>
                        <td>{{$item->TongTien}}</td>
                        <td>{{$item->TrangThai}}</td>
                        <td>
                            <button class="btn-detail"><a href="{{route('CTDH', ['id'=>$item->MaDonHang])}}">Chi tiết</a></button>
                        </td>
                        
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7">Không có đơn hàng</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @else
        @foreach($taikhoan as $data)
            <div class="ThongTinCaNhan">
                <table>
                    <caption><h2>Thông tin cá nhân</h2></caption>
                    <tr>
                        <td><label for="name">Họ và tên</label></td>
                        <td><div class="hoTen">{{$data->HoVaTen}}</div></td>
                    </tr>
                    <tr>
                        <td><label for="dateOfBirth">Ngày sinh</label></td>
                        <td><div class="ngaysinh"><?php echo $data->NgaySinh?></div></td>
                    </tr>
                    <tr>
                        <td><label for="username">Tên tài khoản</label></td>
                        <td><div class="username"><?php echo $data->TenTaiKhoan?></div></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><div class="email"><?php echo $data->Email?></div></td>
                    </tr>
                    <tr>
                        <td><label for="DiaChi">Địa chỉ</label></td>
                        <td><div class="DiaChi"><?php echo $data->DiaChi?></div></td>
                    </tr>
                    <tr>
                        <td><label for="SoDT">Số điện thoại</label></td>
                        <td><div name="SoDT"><?php echo $data->SoDT?></div></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <a href="{{route('ThongTinCaNhan.suaThongTin')}}"><input id="btn_thaydoi" type="button" value="Thay đổi"></a></td>
                    </tr>
                </table>
            </div>
        @endforeach
    @endif
    </section>
@endsection
