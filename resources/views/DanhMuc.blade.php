<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/DanhMuc.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giày QHP</title>
</head>
<body>
    <header>
        <div class="htren">
            <div class="hotline"><p>Hotline: 0987666666</p></div>
            <div class="checking-order"><a href="#"><p>Kiểm tra đơn hàng</p></a></div>
            <div class="login">
                <a href="DangNhap">Log in</a>
                <pre>|</pre>
                <a href="DangKy">Register</a>
            </div>
        </div>
        <div class="hduoi">
            <a href="/"><img src="{{ asset('assets/images/Logo.PNG')}}" alt="LOGO"></a>
            <nav>
                <ul>
                    <li><a href="#">About us</a></li>
                    <li class="nam">
                        <a href="DanhMuc">Nam</a>
                        <ul class="namnam">
                            <li><a href="#">Giày chạy bộ</a></li>
                            <li><a href="#">Giày training</a></li>
                            <li><a href="#">Giày thời trang</a></li>
                            <li><a href="#">Giày leo núi</a></li>
                        </ul>
                    </li>
                    <li class="nu">
                        <a href="DanhMuc">Nữ</a>
                        <ul class="nunu">
                            <li><a href="#">Giày chạy bộ</a></li>
                            <li><a href="#">Giày training</a></li>
                            <li><a href="#">Giày thời trang</a></li>
                            <li><a href="#">Giày leo núi</a></li>
                        </ul>
                    </li>
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
                @if (session()->has('TenTaiKhoan'))
                    <a class="acc" ><div><i class="fa-solid fa-user"></i></div>
                        <input type="hidden" name="_token" id="" value="<?php echo csrf_token() ?>">
                        <div class="loguot" onclick="logout()">Logout </div>
                    </a>

                @endif

            <a href="./GioHang"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
        </div>
    </header>
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
            <div class="color-filter">
                <strong><p>Màu Sắc:</p></strong>
                <div class="color-boxes">
                    <div class="color-box" style="background-color: black;"></div>
                    <div class="color-box" style="background-color: orange;"></div>
                    <div class="color-box" style="background-color: #ecdcc2;"></div>
                    <div class="color-box" style="background-color: red;"></div>
                    <div class="color-box" style="background-color: green;"></div>
                    <div class="color-box" style="background-color: lightblue;"></div>
                    <div class="color-box" style="background-color: brown;"></div>
                </div>
            </div>
            <div class="price-filter">
                <strong><p>Giá:</p></strong>
                <div class="price-scope">
                    <input type="checkbox" id="scope1">
                    <label for="scope1">$30 - $40</label>
                </div>
                <div class="price-scope">
                    <input type="checkbox" id="scope2">
                    <label for="scope2">$40 - $50</label>
                </div>
                <div class="price-scope">
                    <input type="checkbox" id="scope3">
                    <label for="scope3">$50 - $60</label>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="title0"><p>NAM</p></div>
            <div class="danhmuc">
                <ul>
                    <li><a href="#">Giày chạy bộ</a></li>
                    <li><a href="#">Giày training</a></li>
                    <li><a href="#">Giày thời trang</a></li>
                    <li><a href="#">Giày leo núi</a></li>
                </ul>
            </div>
            <div class="sp-nam">
                <div class="hang">
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                </div>
                <div class="hang">
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                </div>
                <div class="hang">
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                </div>
                <div class="hang">
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                    <div class="cot">
                        <a href="#"><img src="{{ asset('assets/images/Image 4.png')}}" alt="Giay"></a>
                        <a href="#"><p class="tensp">Multicolor Men's Sneaker</p></a>
                        <a href="#"><p class="price">$60</p></a>
                    </div>
                </div>
                <div class="view-more">
                    <a href="#"><button>VIEW MORE PRODUCTS</button></a>
                </div>
            </div>
        </div>

    </div>
    <div class="feed-back">
        <div class="title3"><p>HASHTAG QHP FOR THE CHANCE TO BE ON OUR WEBSITE</p></div>
        <div class="fb">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
            <img src="{{ asset('assets/images/Image 26.png')}}" alt="feed back">
        </div>
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
        <div class="LOGO"><img src="{{ asset('assets/images/Logo.PNG')}}" alt="LOGO"></div>
    </footer>
</body>
<script>
    function logout(){
        let url = "{{ route('checkout') }}";

        document.location.href=url;
    }
</script>
</html>
