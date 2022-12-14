@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/DangKy.css')}}">

    <section>
        <form action="/DangKyinfo" method="post">
            <table>

                <caption><h2>Đăng ký tài khoản</h2></caption>
                <tr>
                    <td><label for="name">Họ và tên</label></td>
                    <td><input type="text" name="fullname"></td>
                    <span>
                        @error('fullname')
                            <div class="noti" style="top: 22%">{{$message}}</div>
                        @enderror
                    </span>
                </tr>
                <tr>
                    <td><label for="dateOfBirth">Ngày sinh</label></td>
                    <td><input type="date" name="dob" ></td>
                    <span>
                        @error('dob')
                            <div class="noti" style="top: 34%">{{$message}}</div>
                        @enderror
                    </span>
                </tr>
                <tr>
                    <td><label for="username">Tên tài khoản</label></td>
                    <td><input type="text" name="username"></td>
                    <span>
                        @error('username')
                            <div class="noti" style="top: 46%">{{$message}}</div>
                        @enderror
                    </span>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" name="email"></td>
                    <span>
                        @error('email')
                            <div class="noti" style="top: 57%">{{$message}}</div>
                        @enderror
                    </span>
                </tr>
                <tr>
                    <td><label for="password">Mật khẩu</label></td>
                    <td><input type="password" name="password"></td>
                    <span>
                        @error('password')
                            <div class="noti" style="top: 68%">{{$message}}</div>
                        @enderror
                    </span>
                </tr>
                <tr>
                    <td><label for="phoneNum">Số điện thoại</label></td>
                    <td><input type="text" name="phoneNum"></td>
                    <span>
                        @error('phoneNum')
                            <div class="noti" style="top: 80.2%">{{$message}}</div>
                        @enderror
                    </span>
                    <div class="info">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </tr>
                <tr>
                    <input type="hidden" name="_token" id="" value="<?php echo csrf_token() ?>">
                    <td colspan="2" align="center" style="padding-top: 30px" ><input type="submit" id="submit" value="Đăng Ký" style="margin-bottom: 25px; width:250px" ></td>
                    @csrf
                </tr>
            </table>
        </form>
    </section>
    @endsection
