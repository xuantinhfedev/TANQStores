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
					<form action="" class="orders-filter">
						<div class="filter-col">
							<label for="from_date" style="font-size:18px; margin-right:5px;">Từ ngày</label>
							<input type="date" name="from_date" id="from_date" class="date-filter" value="{{ request()->from_date }}">
							<label for="to_date" style="font-size:18px; margin-right:5px; margin-left:5px;">Đến ngày</label>
							<input type="date" name="to_date" id="to_date" class="date-filter" value="{{ request()->to_date }}">
						</div>
						<div class="filter-col">
								<select name="status" id="status" class="select-categories">
									<option value="0">Tất cả trạng thái</option>
									<option value="Chưa giao" {{request()->status=='Chưa giao'?'selected':false}}>Chưa giao</option>
									<option value="Đang giao" {{request()->status=='Đang giao'?'selected':false}}>Đang giao</option>
									<option value="Đã giao" {{request()->status=='Đã giao'?'selected':false}}>Đã giao</option>
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
								<th>ID</th>
								<th>Tên khách hàng</th>
								<th>Địa chỉ</th>
								<th>Ngày đặt hàng</th>
								<th>Số điện thoại</th>
								<th>Trạng thái</th>
								<th>Chi tiết</th>
								<th>Hủy</th>
							</tr>
						</thead>
						<tbody>
							@if (!empty($ordersList))
								@foreach ($ordersList as $key => $item)
							<tr>
								<td>{{$item->MaDonHang}}</td>
								<td>{{$item->HoVaTen}}</td>
								<td>{{$item->DiaChiNhanHang}}</td>
								<td>{{$item->NgayDatHang}}</td>
                                <td>{{$item->SoDT}}</td>
								<td>{{$item->TrangThai}}</td>
                                <td>
                                    <button class="btn-detail"><a href="{{route('orders.detail', ['id'=>$item->MaDonHang])}}">Chi tiết</a></button>
                                </td>
								<td>
									@if ($item->TrangThai == 'Chưa giao')
										<button class="btn-del">
											<a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
											href="{{route('orders.delete', ['id'=>$item->MaDonHang])}}">Hủy</a>
										</button>
									@endif
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="7">Không có đơn hàng</td>
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
