<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{ asset('assets/css/users/add.css')}}">
	<!-- CSS only -->
	{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
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
                <form action="" method="POST">
                    <table>
						{{-- <caption><h1>{{$title}}</h1></caption> --}}
                        <tr>
                            <td width="15%"><label for="name">Tên danh mục</label></td>
                            <td width="95%"><input type="text" name="name" id="name" maxlength="15" value="{{old('name')}}">
								@error('name')
									<span style="color: red; font-size:14px;">*{{$message}}</span>
								@enderror
							</td>
                        </tr>
                        <tr>
							<td colspan="2" style="padding-left: 15%;">
								<button class="btn-add" type="submit">Thêm mới</button>
								<button class="btn-back"><a href="{{route('danhmuc.index')}}">Quay lại</a></button>
							</td>
						</tr>
                    </table>
                    @csrf
                </form>
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
