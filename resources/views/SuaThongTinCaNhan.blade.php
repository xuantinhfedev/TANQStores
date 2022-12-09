@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/DangKy.css')}}">
    <section>
        <form action="" method="post">
            <table>
                <caption><h2>Sửa thông tin cá nhân</h2></caption>
                <?php foreach($taikhoan as $data){ ?>
                <tr>
                    @if($errors->any())
                    <td colspan="2" class="alert">Dữ liệu nhập vào không hợp lệ. Vui lòng kiểm tra lại !</td>
                    @endif
                </tr>
                <tr>
                    <td><label for="name">Họ và tên</label></td>
                    <td><input type="text" name="name" value="{{old('name')??$data->HoVaTen}}"></td>
                </tr>
                <tr>
                    @error('name')
                        <td colspan="2"><span class="alert">{{$message}}</span></td>
                    @enderror
                </tr>
                <tr>
                    <td><label for="dateOfBirth">Ngày sinh</label></td>
                    <td><input type="date" name="dateOfBirth" value="{{old('dateOfBirth')??$data->NgaySinh}}"></td>
                </tr>
                <tr>
                    @error('dateOfBirth')
                        <td colspan="2"><span class="alert">{{$message}}</span></td>
                    @enderror
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" name="email" value="{{old('email')??$data->Email}}"></td>
                    <td colspan="2"><?php  ?></td>
                </tr>
                <tr>
                    @error('email')
                        <td colspan="2"><span class="alert">{{$message}}</span></td>
                    @enderror
                </tr>
                <tr>
                    <td><label for="DiaChi">Địa chỉ</label></td>
                    <td><input type="text" name="DiaChi" value="{{old('DiaChi')??$data->DiaChi}}"></td>
                </tr>
                <tr>
                    <td><label for="phoneNum">Số điện thoại</label></td>
                    <td><input type="text" name="phoneNum" value="{{old('phoneNum')??$data->SoDT}}"></td>
                </tr>
                <tr>
                    @error('phoneNum')
                        <td colspan="2"><span class="alert">{{$message}}</span></td>
                    @enderror
                </tr>
                <?php } ?>
                <tr>
                    <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                    <td colspan="2" align="center">
                        <a href="{{route('ThongTinCaNhan.index')}}"><input class="btn_back" type="button" value="Quay lại"></a>
                        <input type="submit" id="submit" value="LƯU">
                    </td>
                </tr>
            </table>
        </form>
    </section>
@endsection
