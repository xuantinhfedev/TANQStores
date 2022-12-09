@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/Search.css') }}">
    <div class="content">
        <div class="product">
            <div class="title0">
                <p>Kết quả tìm kiếm cho "{{$key}}"</p>
                <p style="font-size:16px;">({{count($foundProducts)}} sản phẩm)</p>
            </div>
            <div class="sp-nam">
                @if (!empty($foundProducts))
                    @foreach($foundProducts as $key=>$item)
                        @if ($key % 4 == 0)
                            <div class="hang">
                        @endif
                        <div class="cot">
                            <a href="#"><img src="{{ asset('storage/products/' . $item->HinhAnh) }}" alt="Giay"></a>
                            @if($item->KhuyenMai != null)
                    <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(247, 92, 92)">{{$item->GiaBan}}đ</p></a>
                    <a href="#"><p class="price">{{$item->GiaBan*(100-$item->KhuyenMai)/100}}đ</p></a>
                    @else
                    <a href="#"><p class="price" >{{$item->GiaBan}}đ</p></a>
                    @endif
                        </div>
                        @if ($key % 4 == 3 || ($key+1 == count($foundProducts)))
                            </div>
                        @endif
                    @endforeach
                    <div class="view-more">
                        <a href="#"><button>VIEW MORE PRODUCTS</button></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
