
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/xemChiTiet.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giày QHP</title>
</head>
<body>
<header>
        <div class="htren">
            <div class="hotline"><p>Hotline: 0987666666</p></div>
            <div class="checking-order"><a href="#">Kiểm tra đơn hàng</a></div>
            <div class="login">
                <a href="/dangNhap">Log in <input type="hidden" name="_token" value="<?php echo csrf_token();?>"></a>
                <pre>|</pre>
                <a href="/dangKy">Register <input type="hidden" name="_token" value="<?php echo csrf_token();?>"></a>
            </div>
        </div>
        <div class="hduoi">
            <a href="../"><img src="{{ asset('assets/images/Logo.PNG')}}" alt="LOGO"> <input type="hidden" name="_token" value="<?php echo csrf_token();?>"></a>
            <nav>
                <ul>
                    <li><a href="#">About us</a></li>
                    <?php foreach($danhmuc as $datadm){ ?>
                        <li class="nam">
                            <a href="{{route('XemDanhMuc.index',['id'=>$datadm->MaDanhMuc])}}"><?php echo $datadm->TenDanhMuc ?> <input type="hidden" name="_token" value="<?php echo csrf_token();?>"></a>
                            <ul class="namnam">
                                <?php foreach($theloai as $data){ ?>
                                    <li><a href="{{route('XemTheLoai.index',['id'=>$data->MaTheLoai])}}"><?php echo $data->TenTheLoai ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php }?>
                    <li><a href="#">Trẻ em</a></li>
                </ul>
            </nav>
            <div class="search">
                <form action="#">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" name="search" id="search">
                </form>
            </div>
            <div class="acc_cart">
                <a class="acc" href="GioHang.html"><div><i class="fa-solid fa-user"></i></div></a>
                <a href="/GioHang"><i class="fa-solid fa-cart-shopping"></i><input type="hidden" name="_token" value="<?php echo csrf_token();?>"></a>
            </div>
        </div>
    </header>
    <div class="chiTietSP">
        <?php
            foreach($sanpham as $data){
        ?>
        <div class="img_sp">
            <div class="big_img">
                <img name = "img_sp" src="<?php echo asset('assets/images/sp1.jpg')?>" alt="Giay">
            </div>
            <div class="small_img">
                <img name = "img_sp" src="<?php echo asset('assets/images/sp1.jpg')?>" alt="Giay">
                <img name = "img_sp" src="<?php echo asset('assets/images/sp1.jpg')?>">
                <img name = "img_sp" src="<?php echo asset('assets/images/sp1.jpg')?>">
                <img name = "img_sp" src="<?php echo asset('assets/images/sp1.jpg')?>">
            </div>
        </div>
        <form action="/GioHang" method="get" class="info_sp">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <div class="name">
                <h1><?php echo $data->TenSP?></h1>
            </div>
            <div class="maSP">
                <p>Mã sản phẩm:</p>
                <span id="MaSP" name="MaSP"><?php echo $data->MaSP ?></span>
            </div>
            <div class="moTa">
                <p><?php echo $data->MoTa ?></p>
            </div>
        <?php
            }
        ?>
            <div class="size_soLuong">
                <div class="size">
                    <h2>SIZE</h2>
                    <select name="SIZE" id="size">
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="41">42</option>
                        <option value="41">43</option>
                    </select>
                </div>
                <div class="soLuong">
                    <h2>SỐ LƯỢNG</h2>
                    <input type="number" name="soLuong" id="soLuong">
                </div>
            </div>
            <div class="btn">
                <div class="themVaoGio">
                    <button>THÊM VÀO GIỎ</button>
                </div>
                <div class="thanhToan">
                    <button type="submit">THANH TOÁN</button>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <div class="support">
            <p class="bold">SUPPORT</p>
            <p>Checking order</p>
            <p>Checkout Method</p>
            <p>Return Policy</p>
        </div>
        <div class="information">
            <p class="bold">INFORMATION</p>
            <p>Store Finder</p>
            <p>Cooperation with</p>
            <p>QHP</p>
            <p>Q&A</p>
        </div>
        <div class="about">
            <p class="bold">ABOUT'S QHP</p>
            <p>About QHP</p>
            <p>QHP Stories</p>
            <p>QHP Development</p>
            <p>Activities</p>
            <p>Contact Us</p>
        </div>
        <div class="LOGO"><img src="<?php echo asset('assets/images/LOGO.png')?>" alt="LOGO"></div>
    </footer>
</body>
</html>