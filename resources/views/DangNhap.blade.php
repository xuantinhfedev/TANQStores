@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/DangNhap.css')}}">
    <section>
        <form action="/DangNhap/Auth" id="dangNhap" method="post">
            <table>
                <h2>Đăng nhập</h2>
                <tr>
                    <td>
                        <div class="icon_form"><i class="fa-solid fa-user"></i></div>
                        <input type="text" placeholder="Tên tài khoản" name="username" maxlength="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        @error('username')
                            <span style="color: red; font-size: " class="thongbao">{{$message}}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="icon_form"><i class="fa-solid fa-lock"></i></div>
                        <input type="password" placeholder="Mật khẩu" name= "password">
                    </td>
                </tr>
                <tr>
                    <td>
                        @error('password')
                            <span style="color: red; font-size: " class="thongbao1">{{$message}}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="another_option"><a href="DangKy">Chưa có tài khoản? Đăng ký</a></td>
                </tr>
                <tr>
                    <td class="another_option"><a href="#" id="loginBtn">Quên mật khẩu?</a></td>
                </tr>
                <tr>
                    <div class="infofail">
                        @if (\Session::has('fail'))
                        <div class="fail">
                            {!! \Session::get('fail') !!}
                        </div>
                        @endif
                    </div>
                </tr>
                <input type="hidden" name="_token" id="" value="<?php echo csrf_token() ?>">
                <tr>
                    <td id="submit"><input type="submit" value="Đăng nhập"></td>
                    @csrf
                </tr>
            </table>
        </form>
        <div id="forgot-pass-form">
            <form>
                <h3>Phục hồi mật khẩu</h3>
                <span>Chúng tôi sẽ gửi mật khẩu về email của bạn!</span><br>
                <div class="form-box">
                    <div class="icon_form"><i class="fa-solid fa-envelope"></i></div>
                    <input type="text" placeholder="Email">
                </div>
                <div class="form-submit">
                    <input type="submit" value="Gửi">
                    <a href="#" id="submitBtn">Hủy bỏ</a>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            document.getElementById("loginBtn").onclick = function(){
                document.getElementById("dangNhap").style.display = "none";
                document.getElementById("forgot-pass-form").style.display = "block";
                return false;
            }
            document.getElementById("submitBtn").onclick = function(){
                document.getElementById("forgot-pass-form").style.display = "none";
                document.getElementById("dangNhap").style.display = "";
                return false;
            }
        </script>
    </section>
    @endsection
