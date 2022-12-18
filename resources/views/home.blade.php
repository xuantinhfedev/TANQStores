@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/stylehome.css')}}">
<style>
    .img-fill {
        width: 100%;
        height: 100%;
    }
</style>
<div class="row row-height">
    <div id="slideshow" class="carousel slide carousel-width" data-bs-ride="carousel">
        <div class="carousel-inner slide-show__contain">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fill" src="{{ asset('assets/images/bananas2.jpg') }}">
                </div>
                <div class="carousel-item">
                    <img class="img-fill" src="{{ asset('assets/images/bananas1.jpg') }}">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev btn-prev" type="button" data-bs-target="#slideshow"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next btn-next" type="button" data-bs-target="#slideshow"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


    <div class="content">
        <div class="title0"><p>SẢN PHẨM</p></div>
        <div class="sp-nam">
            <div class="title1"><img src="{{ asset('assets/images/giaynam.png')}}" alt="nam"></div>
                @if (!empty($SanPhamList))
                    <div class="hang">
                        @for($j = 0; $j < 4; $j++)
                        @php if($SanPhamList[$j]->KhuyenMai != null)echo "";  @endphp
                        <div class="cot">
                            <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$SanPhamList[$j]->HinhAnh)}}" alt="Giay">@if($SanPhamList[$j]->KhuyenMai != null) <div class="sale">{{"-".$SanPhamList[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                            <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><p class="tensp">{{$SanPhamList[$j]->TenSP}}</p></a>
                            @if($SanPhamList[$j]->TongSoLuongCon==0)
                                <img src="{{ asset('assets/images/hết hàng.png')}}" alt="" style="position: absolute; top:-5%;left: -30%;">
                            @endif
                            @if($SanPhamList[$j]->KhuyenMai != null)
                            <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                            <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a>
                            @else
                            <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                            @endif
                            {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                        </div>
                        @endfor
                    </div>
							@else
							<tr>
								<td colspan="4">Sản phẩm</td>
							</tr>
				@endif

            </div>
        </div>
        <div class="view-more">
            <a href="{{route('XemDanhMuc.index',[1])}}"><button>Xem thêm sản phẩm</button></a>
        </div>
        <div class="sp-nu">
            <div class="title2"><img src="{{ asset('assets/images/giaynu.jpg')}}" alt="nu"></div>
            @if (!empty($sanphamnu))
            <div class="hang">
                @for($j = 0; $j < 4; $j++)
                @php if($sanphamnu[$j]->KhuyenMai != null)echo "";  @endphp
                <div class="cot">
                    <a href="{{route('chitiet',['id' => $sanphamnu[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$sanphamnu[$j]->HinhAnh)}}" alt="Giay">@if($sanphamnu[$j]->KhuyenMai != null) <div class="sale">{{"-".$sanphamnu[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                    <a href="{{route('chitiet',['id' => $sanphamnu[$j]->MaSP]) }}"><p class="tensp">{{$sanphamnu[$j]->TenSP}}</p></a>
                    @if($sanphamnu[$j]->KhuyenMai != null)
                    <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$sanphamnu[$j]->GiaBan}}đ</p></a>
                    <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$sanphamnu[$j]->GiaBan*(100-$sanphamnu[$j]->KhuyenMai)/100}}đ</p></a>
                    @else
                    <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$sanphamnu[$j]->GiaBan}}đ</p></a>
                    @endif
                    {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                </div>
                @endfor
            </div>
                    @else
                    <tr>
                        <td colspan="4">Không có sản phẩm</td>
                    </tr>
            @endif
        </div>
        <div class="view-more">
            <a href="{{route('XemDanhMuc.index',[2])}}"><button>Xem Thêm Sản Phẩm</button></a>
        </div>

        <div class="sp-nu">

            @if (!empty($sanphamhot))
            <div class="title2" style="text-align: center; font-size: 30px; margin: 10px">Sản phẩm bán chạy</div>
                @if(count($sanphamhot)<=5)
                    <div class="hang">
                            @for($j = 0; $j < count($sanphamhot); $j++)
                            @php if($sanphamhot[$j]->KhuyenMai != null)echo "";  @endphp
                            <div class="cot">
                                <a href="{{route('chitiet',['id' => $sanphamhot[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$sanphamhot[$j]->HinhAnh)}}" alt="Giay">@if($sanphamhot[$j]->KhuyenMai != null) <div class="sale">{{"-".$sanphamhot[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                                <a href="{{route('chitiet',['id' => $sanphamhot[$j]->MaSP]) }}"><p class="tensp">{{$sanphamhot[$j]->TenSP}}</p></a>
                                @if($sanphamhot[$j]->KhuyenMai != null)
                                <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$sanphamhot[$j]->GiaBan}}đ</p></a>
                                <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$sanphamhot[$j]->GiaBan*(100-$sanphamhot[$j]->KhuyenMai)/100}}đ</p></a>
                                @else
                                <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$sanphamhot[$j]->GiaBan}}đ</p></a>
                                @endif
                                {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                            </div>
                            @endfor
                    </div>
                @else
                    <div class="hang">
                            @for($j = 0; $j < count(@sanphamhot); $j++)
                            @php if($sanphamhot[$j]->KhuyenMai != null)echo "";  @endphp
                            <div class="cot">
                                <a href="{{route('chitiet',['id' => $sanphamhot[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$sanphamhot[$j]->HinhAnh)}}" alt="Giay">@if($sanphamhot[$j]->KhuyenMai != null) <div class="sale">{{"-".$sanphamhot[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                                <a href="{{route('chitiet',['id' => $sanphamhot[$j]->MaSP]) }}"><p class="tensp">{{$sanphamhot[$j]->TenSP}}</p></a>
                                @if($sanphamhot[$j]->KhuyenMai != null)
                                <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$sanphamhot[$j]->GiaBan}}đ</p></a>
                                <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$sanphamhot[$j]->GiaBan*(100-$sanphamhot[$j]->KhuyenMai)/100}}đ</p></a>
                                @else
                                <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$sanphamhot[$j]->GiaBan}}đ</p></a>
                                @endif
                                {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                            </div>
                            @endfor
                    </div>
                @endif
            @endif
        </div>
    </div>


@endsection
@section('scripts')
<script>
    function logout(){
        let url = "{{ route('checkout') }}";

        document.location.href=url;
    }

</script>
@endsection
