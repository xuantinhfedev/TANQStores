<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>XUNA SHOP</title>
</head>

<body>
    <header>
        <div class="htren">
            <div class="hotline">
                <p>
                    <i class="fa-solid fa-phone"></i>
                    Hotline: 0983669621</p>
            </div>
            <div class="checking-order"><a href="{{ route('KTDonHang') }}">
                <i class="fa-solid fa-cart-shopping" style="color: white; font-size: 14px"></i>
                Kiểm tra đơn hàng</a></div>
            <div class="login">
                @if (!session()->has('TenTaiKhoan'))
                    <a style="padding: 0" href="{{ route('DangNhap') }}">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Đăng Nhập</a>
                        <span style="color: white; margin: 0; padding: 0 5px">|</span>
                        <a href="{{ route('DangKy') }}">
                            <i style="font-size: 12px" class="fa-regular fa-registered"></i>
                        Đăng Ký</a>
                @else
                    <a href="{{ route('ThongTinCaNhan.index') }}">@php echo "<i class="."fa-regular fa-user"."></i>".session()->get('TenTaiKhoan') @endphp</a>
                    <a href="{{ route('checkout') }}">Đăng xuất</a>
                @endif

            </div>
        </div>

        <div class="row" style="
        display: flex;
        align-items: center;">
            <div class="col-3" style="text-align: center">
                <a href="{{ route('home') }}"><img style=" width: 190px" src="{{ asset('assets/images/logo.jpg') }}"
                alt="LOGO"></a>
            </div>
            <div class="col-5">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">Trang chủ</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a style="font-size: 20px" class="nav-link" href="{{ route('XemDanhMuc.index', ['id' => 1]) }}">
                                    <i style="padding-right: 4px" class="fa-solid fa-mars"></i>Nam <input type="hidden" name="_token"
                                        value="<?php echo csrf_token(); ?>"></a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 20px" class="nav-link" href="{{ route('XemDanhMuc.index', ['id' => 2]) }}">
                                    <i style="padding-right: 4px" class="fa-solid fa-venus"></i>Nữ <input type="hidden" name="_token"
                                        value="<?php echo csrf_token(); ?>"></a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 20px" class="nav-link" href="{{ route('XemDanhMuc.index', ['id' => 3]) }}">
                                    <i style="padding-right: 4px" class="fa-solid fa-child"></i>Trẻ em <input type="hidden" name="_token"
                                        value="<?php echo csrf_token(); ?>"></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-2">
                <form action="{{ route('search-products') }}" method="get">
                    <div class="input-group">
                        <div class="form-outline">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Tìm kiếm..."/>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-1">
                <a href="{{ route('giohang') }}"><i class="fa-solid fa-cart-shopping GH">
                    @php
                        if (session()->has('TenTaiKhoan')) {
                            $loaigio = 'GH';
                        } else {
                            $loaigio = 'cart';
                        }
                    @endphp
                    @if (Session($loaigio) != null)
                        <div class="carthover">
                            @if (session($loaigio))
                                @php echo count(Session::get($loaigio, array())); @endphp
                            @endif
                        </div>
                    @else
                        <div class="carthover" style="display: none"></div>
                    @endif
                </i></a>
            </div>
        </div>
    </header>




    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Kết nối với chúng tôi</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">
                            <div><a href="{{ route('home') }}"><img style=" width: 190px"
                                        src="{{ asset('assets/images/logo.jpg') }}" alt="LOGO"></a></div>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Sản phẩm
                        </h6>
                        <p>
                            <span>Giày thu đông</span>
                        </p>
                        <p>
                            <span>Giày thể thao</span>
                        </p>
                        <p>
                            <span>Giày chạy bộ</span>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Link tham khảo
                        </h6>
                        <p>
                            <a style="text-decoration: none"
                                href="https://beclassy.vn/?gclid=Cj0KCQiA4uCcBhDdARIsAH5jyUkYzlBqEo6TXSB4YjfxoezCHzKgHMBCiVryVqbWpF06giLqVZDtkIQaAnnjEALw_wcB"
                                class="text-reset">Tìm hiểu về giày</a>
                        </p>
                        <p>
                            <a style="text-decoration: none"
                                href="https://www.elleman.vn/thoi-trang/giay-nam-gioi-elleman-2022#:~:text=Ngay%20c%E1%BA%A3%20khi%20%C4%91%C3%A3%20b%C6%B0%E1%BB%9Bc,c%C5%A9ng%20r%E1%BA%A5t%20%C4%91%C6%B0%E1%BB%A3c%20%C6%B0a%20chu%E1%BB%99ng."
                                class="text-reset">Xu hướng</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> Bắc Từ Liêm - Hà Nội</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            xunatinhfff@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> +(84) 856529972</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">XunaShop - Group 12</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"
        integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
@yield('scripts')

</html>