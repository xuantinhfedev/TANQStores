@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/XemDanhMuc.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/stylehome.css')}}">
    </header>
    <div class="content">
        <div class="filters">
            <form action="{{route('LocDM')}}" method="POST" id="form">
            {{-- <div class="size-filter">
            
                <strong><p>Size:</p></strong>
                <div class="size">
                    <ul>
                        @for ( $i = 24; $i < 46; $i++)
                            <li id="{{$i}}"  onclick="SelecetSize({{$i}})">{{$i}}</li>
                        @endfor
                        
                    </ul>
                </div>
            </div> --}}
            <div class="select-box">
                <div class="labe" style="text-align: center; width:200px; "><label for="select-box1" class="label select-box1"><span class="label-desc" style="color:rgb(7, 77, 189);font-size:20px">Kích cỡ:</span> </label></div>
                
                <input type="hidden" class="SizeLoc" name="SizeLoc" id="SizeLoc" value="0">
                
                <input type="hidden" class="MaDM" name="MaDM" id="MaDM" value="{{$id}}">
                <select id="select-box1" class="select" onchange="ChangeSelect()">
                    <option value="0">Tất cả các kích cỡ</option>
                    @for ( $i = 24; $i < 46; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                
                </select>
                
            </div>
            <div class="price-filter">
                <div class="range-slider">
                    <p style="padding-bottom: 5px;color:rgb(7, 77, 189);font-size:20px ">Giá:</p>
                  <span class="rangeValues"></span>
                  <input value="1000" min="1000" max="50000" name="Value1" step="500" type="range" class="Rang1Value">
                  <input value="2000000" min="1000" max="2000000" name="Value2" step="500" type="range">
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                
              </div>
              <div id="submit"><input type="submit" value="Lọc"></div>
            </form>
        </div>
        <div class="product">
            @if(isset($sp))
            @if(empty($sp))
                <div class="title0"><p>Không có sản phẩm phù hợp</p></div>
            @endif
            <div class="sp-nam">
                <div class="hang">
                        @foreach ($sp as $item)
                            
                        @php if($item->KhuyenMai != null)echo "";  @endphp
                        <div class="cot">
                            <a href="{{route('chitiet',['id' => $item->MaSP]) }}"><img src="{{ asset('storage/products/'.$item->HinhAnh)}}" alt="Giay">@if($item->KhuyenMai != null) <div class="sale">{{"-".$item->KhuyenMai ."%"}}</div>  @endif</a>
                            <a href="{{route('chitiet',['id' => $item->MaSP]) }}"><p class="tensp">{{$item->TenSP}}</p></a>
                            @if($item->KhuyenMai != null)
                            <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$item->GiaBan}}đ</p></a>
                            <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$item->GiaBan*(100-$item->KhuyenMai)/100}}đ</p></a>
                            @else
                            <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$item->GiaBan}}đ</p></a>
                            @endif
                            {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                        </div>
                        @endforeach
                </div>
            </div>
            @else
            <?php foreach($dmid as $tendm){  ?>
                <div class="title0"><p><?php echo $tendm->TenDanhMuc; session()->put('MaDanhMuc',$tendm->MaDanhMuc) ?></p></div>
                <?php }?>
                <div class="danhmuc">
                    <ul>
                        <?php
                            foreach($theloai as $data){
                        ?>
                        <li><a href="{{route('XemTheLoai.index',['id'=>$data->MaTheLoai])}}"><?php echo $data->TenTheLoai ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="sp-nam">
                        @if (!empty($SanPhamList))
                            @if(count($SanPhamList) <= 5)
                                <div class="hang">
                                    @for($j = 0; $j < count($SanPhamList); $j++)
                                    @php if($SanPhamList[$j]->KhuyenMai != null)echo "";  @endphp
                                    <div class="cot">
                                        <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$SanPhamList[$j]->HinhAnh)}}" alt="Giay">@if($SanPhamList[$j]->KhuyenMai != null) <div class="sale">{{"-".$SanPhamList[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                                        <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><p class="tensp">{{$SanPhamList[$j]->TenSP}}</p></a>
                                        @if($SanPhamList[$j]->KhuyenMai != null)
                                        <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                                        <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a>
                                        @else
                                        <a href="#"><p class="price"  style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                                        @endif
                                        {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                                    </div>
                                    @endfor
                                </div>
                            @else
                                <div class="hang">
                                    @for($j = 0; $j < 5; $j++)
                                    @php if($SanPhamList[$j]->KhuyenMai != null)echo "";  @endphp
                                    <div class="cot">
                                        <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$SanPhamList[$j]->HinhAnh)}}" alt="Giay">@if($SanPhamList[$j]->KhuyenMai != null) <div class="sale">{{"-".$SanPhamList[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                                        <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><p class="tensp">{{$SanPhamList[$j]->TenSP}}</p></a>
                                        @if($SanPhamList[$j]->KhuyenMai != null)
                                        <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                                        <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a>
                                        @else
                                        <a href="#"><p class="price"  style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                                        @endif
                                        {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                                    </div>
                                    @endfor
                                </div>
                                <div class="hang">
                                    @for($j = count($SanPhamList)-1; $j > 4; $j--)
                                    @php if($SanPhamList[$j]->KhuyenMai != null)echo "";  @endphp
                                    <div class="cot">
                                        <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><img src="{{ asset('storage/products/'.$SanPhamList[$j]->HinhAnh)}}" alt="Giay">@if($SanPhamList[$j]->KhuyenMai != null) <div class="sale">{{"-".$SanPhamList[$j]->KhuyenMai ."%"}}</div>  @endif</a>
                                        <a href="{{route('chitiet',['id' => $SanPhamList[$j]->MaSP]) }}"><p class="tensp">{{$SanPhamList[$j]->TenSP}}</p></a>
                                        @if($SanPhamList[$j]->KhuyenMai != null)
                                        <a href="#"><p class="price" style="text-decoration: line-through; color: rgb(150, 140, 140,0.7)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                                        <a href="#"><p class="price" style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a>
                                        @else
                                        <a href="#"><p class="price"  style="color: rgb(233, 81, 81)">{{$SanPhamList[$j]->GiaBan}}đ</p></a>
                                        @endif
                                        {{-- <a href="#"><p class="price">{{$SanPhamList[$j]->GiaBan*(100-$SanPhamList[$j]->KhuyenMai)/100}}đ</p></a> --}}
                                    </div>
                                    @endfor
                                </div>
                            @endif
                        @else
                            <p>Không có sản phẩm</p>
                        @endif
                </div>
            @endif
        </div>
    </div>
@section('scripts')
<script>
    function getVals(){
  // Get slider values
  let parent = this.parentNode;
  let slides = parent.getElementsByTagName("input");
    let slide1 = parseFloat( slides[0].value );
    let slide2 = parseFloat( slides[1].value );
  // Neither slider will clip the other, so make sure we determine which is larger
  if( slide1 > slide2 ){ let tmp = slide2; slide2 = slide1; slide1 = tmp; }
  let displayElement = parent.getElementsByClassName("rangeValues")[0];
//innerHTML property allows Javascript code to manipulate a website being displayed
      displayElement.innerHTML =  slide1 + "đ - " + slide2 +"đ";
}
window.onload = function(){
  // Initialize Sliders
  let sliderSections = document.getElementsByClassName("range-slider");
      for( let x = 0; x < sliderSections.length; x++ ){
        let sliders = sliderSections[x].getElementsByTagName("input");
        for( let y = 0; y < sliders.length; y++ ){
          if( sliders[y].type ==="range" ){
     //oninput attribute fires when the value of an <input> element is changed
            sliders[y].oninput = getVals;
            // Manually trigger event first time to display values
            sliders[y].oninput();
          }
        }
      }
}
</script>
<script src="{{ asset('assets/js/XemDanhMuc.js')}}">
</script>
<script type="text/javascript">
function ChangeSelect(){
    var x = document.getElementsByClassName("select")[0].value;
    console.log(x);
  document.getElementById("SizeLoc").value =  x;
}
</script>
@endsection
@endsection
