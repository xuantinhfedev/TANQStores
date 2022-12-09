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
				<div class="table-list">
					<button class="btn-add"><a href="{{route('products.add')}}">Thêm sản phẩm</a></button>
					<hr>
					<form action="" class="data-filter">
						<div class="filter-col">
							<select name="collections" id="collections" class="select-collections">
								<option value="0">Tất cả danh mục</option>
								@if (!empty(getAllDanhMuc()))
									@foreach (getAllDanhMuc() as $item)
										<option value="{{$item->MaDanhMuc}}" {{request()->collections==$item->MaDanhMuc?'selected':false}}>
											{{$item->TenDanhMuc}}
										</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="filter-col">
							<select name="categories" id="categories" class="select-categories">
								<option value="0">Tất cả thể loại</option>
								@if (!empty(getAllTheLoai()))
									@foreach (getAllTheLoai() as $item)
										<option value="{{$item->MaTheLoai}}" {{request()->categories==$item->MaTheLoai?'selected':false}}>
											{{$item->TenTheLoai}}
										</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="filter-col">
							<input type="search" name="keywords" class="filter-keywords" 
							placeholder="Từ khóa tìm kiếm..." value="{{request()->keywords}}">
						</div>
						<div class="filter-col">
							<button type="submit" class="filter-btn">Lọc</button>
						</div>
					</form>
					<table class="user-list" border="1">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên sản phẩm</th>
								<th>Giá bán</th>
								<th>Mô tả</th>
								<th>Hình ảnh</th>
								<th>Thể loại</th>
								<th>Danh mục</th>
                                <th>Chi tiết</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if (!empty($productsList))
								@foreach ($productsList as $key => $item)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$item->TenSP}}</td>
								<td>{{$item->GiaBan}}đ</td>
								<td>{{$item->MoTa}}</td>

								<td><img src="{{ asset('storage/products/' . $item->HinhAnh) }}" alt="ảnh giày" style="width:60px; height:60px;"></td>
								<td>{{$item->TenTheLoai}}</td>
								<td>{{$item->TenDanhMuc}}</td>
                                <td>
                                    <button class="btn-detail"><a href="{{route('products.details.index', ['id'=>$item->MaSP])}}">Chi tiết</a></button>
                                </td>
								<td>
									<button class="btn-update"><a href="{{route('products.edit', ['id'=>$item->MaSP])}}">Sửa</a></button>
								</td>
								<td>
									<button class="btn-del">
										<a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
										href="{{route('products.delete', ['id'=>$item->MaSP])}}">Xóa</a>
									</button>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="10">Không có sản phẩm</td>
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
