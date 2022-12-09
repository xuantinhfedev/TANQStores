<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/LogInAdmin.css')}}">
</head>
<body>
    <div class="form_group">
        
        <div class="banner">
            <div><img src="{{ asset('assets/images/logo.jpg')}}" style="height: 30px"></div>
            XUNA SHOP ADMIN</div>
        <form action="/DangNhap/Admin" method="post" class="from_main" >
            <div class="form_group_Inp">
                <input type="text"
                 name="username"
                 class="usernameInp"
                 placeholder="  Tài Khoản"
                 >
            </div>
            @error('username')
                            <span style="color: red; font-size: " class="thongbao">{{$message}}</span>
                        @enderror
            <div class="form_group_Inp">
                <input type="password" placeholder="Mật khẩu" name= "password" class="PassInp"  >
            </div>
            @error('password')
            <span style="color: red; font-size: " class="thongbao1">{{$message}}</span>
            @enderror
            <div class="infofail">
                @if (\Session::has('fail'))
                <div class="fail">{!! \Session::get('fail') !!}
                </div>
                @endif
            </div>
            <div class="login_btn">
                <input type="hidden" name="_token" id="" value="<?php echo csrf_token() ?>">
                <input type="submit" class="LoginBtn"  value="Đăng nhập">
                {{-- <button class="LoginBtn">Login</button></div> --}}
        </form>
    </div>

</body>
</html>
