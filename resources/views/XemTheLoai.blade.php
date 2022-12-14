@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/XemDanhMuc.css')}}">
    <div class="content">
        <div class="filters">
            <div class="size-filter">
                <strong><p>Size:</p></strong>
                <div class="size">
                    <ul>
                        <li><a href="#">24</a></li><li><a href="#">25</a></li>
                        <li><a href="#">26</a></li><li><a href="#">27</a></li>
                        <li><a href="#">28</a></li><li><a href="#">29</a></li>
                        <li><a href="#">30</a></li><li><a href="#">31</a></li>
                        <li><a href="#">32</a></li><li><a href="#">33</a></li>
                        <li><a href="#">34</a></li><li><a href="#">35</a></li>
                        <li><a href="#">36</a></li><li><a href="#">37</a></li>
                        <li><a href="#">38</a></li><li><a href="#">39</a></li>
                        <li><a href="#">40</a></li><li><a href="#">41</a></li>
                        <li><a href="#">42</a></li><li><a href="#">43</a></li>
                        <li><a href="#">44</a></li><li><a href="#">45</a></li>
                    </ul>
                </div>
            </div>

            <div class="price-filter">
                <strong><p>Giá:</p></strong>
                <div class="price-scope">
                    <input type="checkbox" id="scope1">
                    <label for="scope1">300.000 - 400.000</label>
                </div>
                <div class="price-scope">
                    <input type="checkbox" id="scope2">
                    <label for="scope2">400.000 - 500.000</label>
                </div>
                <div class="price-scope">
                    <input type="checkbox" id="scope3">
                    <label for="scope3">500.000 - 600.000</label>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="title0"><p><?php foreach($tendm as $name) echo $name->TenDanhMuc ?></p></div>
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
                @if(!empty($sanpham))
                    <div class="hang">
                        <?php $i=0; foreach($sanpham as $data){
                                $i++;
                                if($i==5)
                                    break;
                            ?>
                            <div class="cot">
                            <a href="{{route('chitiet',['id'=>$data->MaSP])}}"><img src="{{ asset('storage/products/'.$data->HinhAnh)}}" alt="Giay"></a>
                            <a href="{{route('chitiet',['id'=>$data->MaSP])}}"><p class="tensp"><?php echo $data->TenSP ?></p><input type="hidden" name="_token" value="<?php echo csrf_token();?>"></a>
                            <a href="#"><p class="price"><?php echo $data->GiaBan?>đ</p></a>
                        </div>
                            <?php } ?>
                    </div>
                @else
                    <div class="hang">
                        <p>Chưa có thêm sản phẩm</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
    @endsection
