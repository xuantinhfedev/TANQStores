<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{ asset('assets/css/users/add.css')}}">
	<title>Document</title>
</head>

<body>
	<header>
		<div class="banner">
			<img src="{{ asset('assets/images/admin site.PNG')}}" class="image_banner" alt="">
		</div>
		<div class="content_header">
			@if (session()->has('admin'))
            <div class="account">
                <div class="name_acc"> Xin Chào {{session()->get('admin')}}
                    <ul class="info_acc">
                        <li onclick="logout()">logout</li>
                    </ul>
                </div>
             </div>
         @endif
		</div>
	</header>
	<div class="mainlayout">
		<div class="nav">
			<ul class="main_select">
				<li><a href="{{route('adminsite')}}"><i class="fa-solid fa-list-ul"></i>Dashboard</li></a>
				<li><a href="{{route('products.index')}}"><i class="fa-solid fa-shoe-prints"></i>Quản Lý Sản Phẩm</li></a>
				<li><a href="{{route('danhmuc.index')}}"><i class="fa-solid fa-sheet-plastic"></i>Quản Lý Danh Mục</li></a>
				<li><a href="{{route('theloai.index')}}"><i class="fa-regular fa-rectangle-list"></i>Quản Lý Thể Loại</li></a>
				<li><a href="{{route('orders.index')}}"><i class="fa-solid fa-bag-shopping"></i>Quản Lý Đơn Hàng</li></a>
				<li><a href="{{route('users.index')}}"><i class="fa-solid fa-user"></i>Quản Lý Tài Khoản</li></a>
				<li><a href="{{route('thongke')}}"><i class="fa-solid fa-arrow-up-right-dots"></i>Thống kê doanh thu</li></a>
			</ul>
		</div>
		<div class="container">
			<div class="maincontent">
                <form action="{{route('users.post-edit')}}" method="POST">
                    <table>
						<caption><h1>{{$title}}</h1></caption>
                        <tr>
                            <td width="15%"><label for="fullname">Họ và tên</label></td>
                            <td width="95%"><input type="text" name="fullname" id="fullname" value="{{old('fullname') ?? $userDetail->HoVaTen}}">
								@error('fullname')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>

                        </tr>
                        <tr>
                            <td><label for="dob">Ngày sinh</label></td>
                            <td><input type="date" name="dob" id="dob" value="{{old('dob') ?? $userDetail->NgaySinh}}">
								@error('dob')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>
                        </tr>
                        <tr>
                            <td><label for="username">Tên tài khoản</label></td>
                            <td><input type="text" name="username" id="username" value="{{old('username') ?? $userDetail->TenTaiKhoan}}">
								@error('username')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="text" name="email" id="email" value="{{old('email') ?? $userDetail->Email}}">
								@error('email')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>
                        </tr>
                        <tr>
                            <td><label for="password">Mật khẩu</label></td>
                            <td><input type="password" name="password" id="password" value="{{old('password') ?? $userDetail->password}}">
								@error('password')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>
                        </tr>
                        <tr>
                            <td><label for="phoneNum">Số điện thoại</label></td>
                            <td><input type="text" name="phoneNum" id="phoneNum" value="{{old('phoneNum') ?? $userDetail->SoDT}}">
								@error('phoneNum')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>
                        </tr>
                        <tr>
                            <td>Admin</td>
                            <td>
                                <input type="radio" class="rad" name="admin" id="isAdmin" value="1" {{($userDetail->IsAdmin == 1 ? 'checked' : '')}}>
                                <label for="isAdmin">Là admin</label> &emsp;
                                <input type="radio" class="rad" name="admin" id="notAdmin" value="0" {{($userDetail->IsAdmin == 0 ? 'checked' : '')}}>
                                <label for="notAdmin" style="margin-right: 50px;">Không là admin</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="address">Địa chỉ</label></td>
                            <td><input type="text" name="address" id="address" value="{{old('address') ?? $userDetail->DiaChi}}"></td>
                        </tr>
						<tr>
							<td colspan="2" style="padding-left: 15%;">
								<button class="btn-add" type="submit">Cập nhật</button>
								<button class="btn-back"><a href="{{route('users.index')}}">Quay lại</a></button>
							</td>
						</tr>
                    </table>
                    @csrf
                </form>

				@if (session('msg'))
				<div class="message">{{session('msg')}}</div>
				@endif
			</div>
		</div>
	</div>
	<footer>

	</footer>
</body>
<script>
    function logout(){
let url = "{{ route('checkoutadmin') }}";

document.location.href=url;
}
</script>
</html>
