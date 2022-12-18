
@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/ThanhToan.css')}}">
    <div class="content">
        <form action="{{route('ThanhToan.postHD')}}" method="post" style="display:flex;" entype="mulitpart/form-data">
        <div class="thongTinGiaoHang">
            <div class="title1">THÔNG TIN GIAO HÀNG</div>
            <div class="inforGiaoHang">
                @if(!empty($taikhoan))
                @foreach($taikhoan as $tk)
                <table>
                    <tr>
                        @if($errors->any())
                        <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2" class="alert">Dữ liệu nhập vào không hợp lệ. Vui lòng kiểm tra lại !</td>
                        @endif
                    </tr>
                    <tr>
                        <td><input type="text" name="name" id="name" placeholder="HỌ TÊN" value="{{old('name')??$tk->HoVaTen}}"></td>
                    </tr>
                    <tr>
                        @error('name')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td><input type="text" name="DiaChi" id="DiaChi" placeholder="ĐỊA CHỈ" value="{{old('DiaChi')??$tk->DiaChi}}"></td>
                    </tr>
                    <tr>
                        @error('DiaChi')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td><input type="text" name="phoneNum" id="phoneNum" placeholder="SỐ ĐIỆN THOẠI" value="{{old('PhomeNum')??$tk->SoDT}}"></td>
                    </tr>
                    <tr>
                        @error('phoneNum')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td><input type="text" name="ghiChu" id="ghiChu" placeholder="GHI CHÚ" value=""></td>
                    </tr>
                    <tr>
                        @error('ghiChu')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                     <tr>
                        <td><input type="text" name="diaChiNhanHang" id="diaChiNhanHang" placeholder="ĐỊA CHỈ NHẬN HÀNG" value="{{old('diaChiNhanHang')??""}}"></td>
                    </tr>
                    <tr>
                        @error('diaChiNhanHang')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td style="padding-left:20px;height: 30px;font-size: 15px;"><b>HÌNH THỨC VẬN CHUYỂN:</b><b>COD (giao hàng thanh toán)</b></td>
                    </tr>
                </table>
                @endforeach
                @else
                <table>
                    <tr>
                        @if($errors->any())
                        <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2" class="alert">Dữ liệu nhập vào không hợp lệ. Vui lòng kiểm tra lại !</td>
                        @endif
                    </tr>
                    <tr>
                        <td><input type="text" name="name" id="name" placeholder="HỌ TÊN" value="{{old('name')??""}}"></td>
                    </tr>
                    <tr>
                        @error('name')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td><input type="text" name="DiaChi" id="DiaChi" placeholder="ĐỊA CHỈ" value="{{old('DiaChi')??""}}"></td>
                    </tr>
                    <tr>
                        @error('DiaChi')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td><input type="text" name="phoneNum" id="phoneNum" placeholder="SỐ ĐIỆN THOẠI" value="{{old('DiaChi')??""}}"></td>
                    </tr>
                    <tr>
                        @error('phoneNum')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td><input type="text" name="ghiChu" id="ghiChu" placeholder="GHI CHÚ" value="{{old('ghiChu')??""}}"></td>
                    </tr>
                     <tr>
                        <td><input type="text" name="diaChiNhanHang" id="diaChiNhanHang" placeholder="ĐỊA CHỈ NHẬN HÀNG" value="{{old('diaChiNhanHang')??""}}"></td>
                    </tr>
                    <tr>
                        @error('diaChiNhanHang')
                            <td style="padding-left:20px;height: 30px;font-size: 15px;" colspan="2"><span class="alert">{{$message}}</span></td>
                        @enderror
                    </tr>
                    <tr>
                        <td style="padding-left:20px;height: 30px;font-size: 15px;"><b>HÌNH THỨC VẬN CHUYỂN:</b><b>COD (giao hàng thanh toán)</b></td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
        <div class="cart-item">
            <div class="title1">ĐƠN HÀNG</div>
            <table>
                <tr>
                    <th style="width: 20%;"></th>
                    <th style="width: 30%; text-align: left; padding-left: 10px;">TÊN SẢN PHẨM</th>
                    <th style="width: 15%; text-align: center;">SỐ LƯỢNG</th>
                    <th style="width: 15%; text-align: right;">GIÁ</th>
                    <th style="width: 20%; text-align: right;">THÀNH TIỀN</th>
                </tr>
                {{-- {{ count((array) session('cart')) }} --}}
                @php $total = 0; @endphp
                @foreach ($SP as $id => $item)
                @php  @endphp
                {{-- @php dd($item[0]->SoLuongCon); @endphp --}}
                {{-- @php $home =  $item['SoLuong'] @endphp --}}
                <tr>
                    <td style="padding: 0px;"><div class="cart-image"><a href="{{route('chitiet',['id' => $item[1]->MaSP]) }}"><img src="{{asset('storage/products/'.$item[1]->HinhAnh)}}" alt="Giay"></div></a></td>
                    <td class="item-name">
                       <a href="{{route('chitiet',['id' => $item[1]->MaSP]) }}">{{$item[1]->TenSP}}</a>
                        <div class="item-infor">
                            {{-- <div class="color">Màu: <div class="item-color"></div></div> --}}
                            @php
                                if($item[1]->KhuyenMai != null)
                                    $total +=($item[1]->GiaBan*(100-$item[1]->KhuyenMai)/100)* $item['SoLuong'];
                                else
                                    $total += $item[1]->GiaBan * $item['SoLuong'];
                            @endphp
                            <div class="size">Size: <div class="item-size">{{$item[0]->Size}}</div></div>
                        </div>
                    </td>
                    <td class="item-quantity">

                        <input type="number" class="SoLuong" min="1"  value="{{$item['SoLuong']}}" readonly onchange="UpdateCart('{{$id}}')" placeholder="">
                        <div class="slKhongHopLe"></div>
                    </td>

                    @if($item[1]->KhuyenMai != null)
                        <td class="item-price">
                            <p style="color: rgb(233, 81, 81)">{{$item[1]->GiaBan*(100-$item[1]->KhuyenMai)/100}}đ</p>
                            <p  style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$item[1]->GiaBan}}đ</p>

                        </td>
                        {{-- <td class="item-price"></td> --}}
                    @else
                        <td><div class="item-price ">{{$item[1]->GiaBan}}đ</div></td>
                    @endif
                    {{-- <td class="item-price">{{$item[1]->GiaBan}}đ</td> --}}
                    <td class="item-total">{{$item[1]->GiaBan *(100-$item[1]->KhuyenMai)/100 * $item['SoLuong']}}đ</td>
                </tr>
                @endforeach
            </table>
            <hr style="margin-top: 30px;">
            <div class="user-total-price">
                <div class="total-price" style="margin-top: 10px; display: block" >
                    @if(session('TenTaiKhoan'))
                        @if($taikhoan[0]->TieuDung>=20000000)
                            <strong>TỔNG CỘNG: 
                                <span style="color: red;">{{$total * 95/100}}đ</span>
                                <span  style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$total}}đ</p>
                                
                            </strong>
                            <div><i style="text-decoration: none">đã giảm 5% thưởng hạng kim cương</i></div>
                        @elseif($taikhoan[0]->TieuDung>=10000000)
                            <strong>TỔNG CỘNG: 
                                <span style="color: red;">{{$total * 96/100}}đ</span>
                                <span  style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$total}}đ</p>
                                
                            </strong>
                            <div><i style="text-decoration: none">đã giảm 4% thưởng hạng vàng</i></div>
                        @elseif($taikhoan[0]->TieuDung>=3000000)
                            <strong >TỔNG CỘNG: 
                                <span style="color: red;">{{$total *98/100}}đ</span>
                                <span  style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$total}}đ</p>
                                
                            </strong>
                            <div><i style="text-decoration: none; ">đã giảm 2% thưởng hạng bạc</i></div>
                        @else
                        <strong>TỔNG CỘNG: <span style="color: red;">{{$total }}đ</span></strong>
                        @endif
                    @else
                        <strong>TỔNG CỘNG: <span style="color: red;">{{$total }}đ</span></strong>
                    
                    @endif
                    
                </div>
            </div>


                @if(isset($DHN))
                    @php session()->put('DHN',$SP); @endphp
                    <input type="hidden" name="DHN" id=""value="{{$DHN}}">

                @elseif((session()->has('TenTaiKhoan')))
                    @php
                        $loaigio = 'GH';
                        $SP["LoaiGio"] = $loaigio;
                        session()->put('SP',$SP);
                    @endphp

                @else
                    @php
                        $loaigio = 'cart';
                        $SP["LoaiGio"] = $loaigio;
                        session()->put('SP',$SP);
                    @endphp

                @endif
                @if(session('TenTaiKhoan'))
                @if($taikhoan[0]->TieuDung>=20000000)
                    <input type="hidden" name="tongTien" value="{{$total * 95/100}}">
                    
                @elseif($taikhoan[0]->TieuDung>=10000000)
                    <input type="hidden" name="tongTien" value="{{$total * 96/100}}">
                    
                @elseif($taikhoan[0]->TieuDung>=3000000)
                    <input type="hidden" name="tongTien" value="{{$total* 98/100}}">
                @else
                    <input type="hidden" name="tongTien" value="{{$total}}">
                @endif
            @else
                <input type="hidden" name="tongTien" value="{{$total}}">
            
            @endif
            <div class="thanhToan">
                    <input type="submit" value="ĐẶT HÀNG">
                </div>
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
        </form>
    </div>
@endsection
@section('script')
<script>
    function logout(){
        let url = "{{ route('checkout') }}";
        document.location.href=url;
    }

</script>
@endsection
