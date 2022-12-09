<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{ asset('assets/css/users/list.css')}}">
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
				<h1>{{$title}}</h1>
				<div class="table-list" style="width:70%; font-size:18px;">
					<button class="btn-add"><a href="{{route('danhmuc.add')}}">Thêm danh mục</a></button>
					<table class="user-list" border="1">
						<thead>
							<tr>
								<th width=10%>STT</th>
								<th>Tên danh mục</th>
								<th width=10%>Sửa</th>
								<th width=10%>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if (!empty($danhmucList))
								@foreach ($danhmucList as $key => $item)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$item->TenDanhMuc}}</td>
								<td>
									<button class="btn-update"><a href="{{route('danhmuc.edit', ['id'=>$item->MaDanhMuc])}}">Sửa</a></button>
								</td>
								<td>
									<button class="btn-del">
										<a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
										href="{{route('danhmuc.delete', ['id'=>$item->MaDanhMuc])}}">Xóa</a>
									</button>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="4">Không có danh mục</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>

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
