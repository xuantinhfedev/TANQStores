@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/GioHang.css')}}">

    <div class="cart">
        <!-- <div class="cart-title"><h2>GIỎ HÀNG CỦA BẠN</h2></div>
        <div class="empty-cart">
            <img src="./images/empty-cart.png" alt="Không có sản phầm nào trong giỏ hàng của bạn">
            <p>Không có sản phẩm nào trong giỏ hàng của bạn.</p><br>
            <button><a href="index.html">Tiếp tục mua sắm</a></button>
        </div> -->
        <div class="cart-item">
            <table class="table1">
                <tr>
                    <th style="width: 15%;"></th>
                    <th style="width: 40%; text-align: left; padding-left: 10px;">TÊN SẢN PHẨM</th>
                    <th style="width: 15%; text-align: center;">SỐ LƯỢNG</th>
                    <th style="width: 15%; text-align: right;">GIÁ</th>
                    <th style="width: 15%; text-align: right;">THÀNH TIỀN</th>
                </tr>
                {{-- {{ count((array) session('cart')) }} --}}
                @php $total = 0; @endphp
                @if(isset($SP))
                @foreach ($SP as $id => $item)
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
                            <div class="btn-delete" onclick="DeleteCart('{{$id}}')">
                                <a href="#">
                                <strong><i class="fa-solid fa-square-xmark"></i>
                                Xóa</strong>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="item-quantity">
                        <input type="number" class="SoLuong" min="1" name="{{$id}}"  value="{{$item['SoLuong']}}" onchange="UpdateCart('{{$id}}')" placeholder="">
                        <input type="hidden" name="" id="{{$id}}" value="{{$item[0]->SoLuongCon}}">
                        <div class="slKhongHopLe" value="{{$id}}"></div>
                    </td>
                    <td >
                        @if($item[1]->KhuyenMai != null)
                        <div class="" style="display: block;">
                            <p class="item-price" style="color: rgb(233, 81, 81)">{{$item[1]->GiaBan*(100-$item[1]->KhuyenMai)/100}}đ</p>
                            <p class="item-price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$item[1]->GiaBan}}đ</p>
                        </div>

                        @else
                            <div class="item-price " style="color: rgb(233, 81, 81)">{{$item[1]->GiaBan}}đ</div>
                        @endif


                    </td>

                    <td class="item-total">
                        @if($item[1]->KhuyenMai != null)
                            {{($item[1]->GiaBan*(100-$item[1]->KhuyenMai)/100)* $item['SoLuong']}}đ
                            <input type="hidden" class="LuuTru" value="{{($item[1]->GiaBan*(100-$item[1]->KhuyenMai)/100)}}">
                        @else
                            {{$item[1]->GiaBan * $item['SoLuong']}}đ
                            <input type="hidden" class="LuuTru" value="{{$item[1]->GiaBan}}" >
                        @endif

                    </td>
                </tr>
                @endforeach
                @endif

            </table>
            <hr style="margin-top: 30px;">
            <div class="cart-pay">
                <div class="shop-support">
                    {{-- <a href="index.html" class="buy-more">
                        <i class="fa-solid fa-circle-arrow-left"></i>
                        Tiếp tục mua hàng
                    </a> --}}

                    <div class="shop-contact">
                        <p>Để nhận tư vấn hoặc hỗ trợ khi phát sinh khó khăn trong lúc mua hàng, hãy liên hệ với XUNA chúng mình thông qua:</p>
                        <ul>
                            <li>
                                Gọi <span class="phone-number"><strong>0983669621 </strong></span>
                            </li>
                            <li>
                                  Email tới địa chỉ
                                <a href="mailto:service.customer@xuna.com" class="email">
                                    <strong>service.customer@xuna.com</strong>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="user-total-price">
                    <div class="total-price">
                        <strong>Tạm Tính: <span style="color: red;">{{$total }}đ</span></strong>
                    </div>
                    <div class="user-pay">
                        <a href="{{route('ThanhToan.index')}}"><input type="button" value="Đặt hàng"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function logout(){
        let url = "{{ route('checkout') }}";

        document.location.href=url;
    }
    async function DeleteCart(id){
        let isExecuted = confirm("Xác Nhận Xóa Sản Phẩm?");

        if(isExecuted){
            id = String(id);
        const data = {ID: id};
        console.log(data)
            // const size = document.getElementById("size").value;
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            fetch('/XoaGH', {
                method: 'post',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            })
            .then(response => response.json())
            .then(response => {
                console.log(response);
            })
            .catch((error) => {
            console.error('Error:', error);
            });
            window.location.reload();
        }

        }
    async function UpdateCart(id){
        let SoLuong = document.querySelector('[name='+id+'').value;

            id = String(id);
        const data = {ID: id, SL: SoLuong};
        console.log(data)
            // const size = document.getElementById("size").value;
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            fetch('/SuaGH', {
                method: 'post',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            })
            .then(response => response.json())
            .then(response => {
                if(response==400){
                    document.querySelector('[value='+id+'').innerHTML="Số lượng yêu cầu không có sẵn";
                    document.querySelector('[name='+id+'').value = document.querySelector('[id='+id+'').value;
                    console.log(document.querySelector('.LuuTru').value*document.querySelector('[id='+id+'').value);
                    document.querySelector('.item-total').innerHTML = document.querySelector('.LuuTru').value * document.querySelector('[id='+id+'').value;
                    window.location.reload();
                }else{
                    console.log(response);
                    window.location.reload();
                }
            })
            .catch((error) => {
                console.error('Error:');
            });

        }
</script>
@endsection
