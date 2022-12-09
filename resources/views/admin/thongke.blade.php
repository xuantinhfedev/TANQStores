<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{ asset('assets/css/ThongKe.css')}}">

    <!--Thư viện vẽ biều đồ-->
    <link rel="stylesheet" href="{{ asset('assets/css/morris.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/js/morris.min.js') }}"></script>

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
				<div class="content">
					<form action="" style="width: 100%;">
						<div class="statistic-option">

							<input type="radio" name="option" id="day_opt" 
							<?php if (!empty($_GET['option']) && $_GET['option']=='1') echo 'checked'; ?> onclick="ThongKeNgay();" value="1">
							<label for="day_opt">Thống kê theo ngày</label>
							

							<input type="radio" name="option" id="month_opt" 
							<?php if (!empty($_GET['option']) && $_GET['option']=='2') echo 'checked'; else if (empty($_GET['option'])) echo 'checked'; ?> onclick="ThongKeThang();" value="2">
							<label for="month_opt">Thống kê theo tháng</label>
							

							<input type="radio" name="option" id="year_opt" 
							<?php if (!empty($_GET['option']) && $_GET['option']=='3') echo 'checked'; ?> onclick="ThongKeNam();" value="3">
							<label for="year_opt">Thống kê theo năm</label>


							<div id="statistic_date">
								<label for="from_date">Từ ngày:</label>
								<input type="date" name="from_date" id="from_date" min="2015-01-01" value="{{ !empty($_GET['from_date']) ? $_GET['from_date'] : '' }}" required>
								<label for="to_date" style="margin-left: 20px;">Đến ngày:</label>
								<input type="date" name="to_date" id="to_date" min="2015-01-01" value="{{ !empty($_GET['to_date']) ? $_GET['to_date'] : '' }}" required>
								@if (session('msg'))
								<div class="message">{{session('msg')}}</div>
								@endif
							</div>

							<div id="statistic_month">
								<label for="from_month">Từ tháng:</label>
								<input type="month" name="from_month" id="from_month" min="2015-01" value="{{ !empty($_GET['from_month']) ? $_GET['from_month'] : '' }}" required>
								<label for="to_month" style="margin-left: 20px;">Đến tháng:</label>
								<input type="month" name="to_month" id="to_month" min="2015-01" value="{{ !empty($_GET['to_month']) ? $_GET['to_month'] : '' }}" required>
								@if (session('msg'))
								<div class="message">{{session('msg')}}</div>
								@endif
							</div>

							<div id="statistic_year">
								<label for="from_year">Từ năm:</label>
								<select name="from_year" name="from_year" id="from_year">
									@for ($y = 2015; $y <= date("Y"); $y++)
										<option value="{{$y}}" {{request()->from_year==$y?'selected':false}}>
											{{$y}}
										</option>
									@endfor
								</select>
								<label for="to_year" style="margin-left: 20px;">Đến năm:</label>
								<select name="to_year" name="to_year" id="to_year">
									@for ($y = 2015; $y <= date("Y"); $y++)
										<option value="{{$y}}" {{request()->to_year==$y?'selected':false}}>
											{{$y}}
										</option>
									@endfor
								</select>
								@if (session('msg'))
								<div class="message">{{session('msg')}}</div>
								@endif
							</div>

							<button type="submit" class="btn_TK">Thống kê</button>
						</div>
					</form>
					
                    <div id="chart"></div>
                </div>
			</div>
		</div>
	</div>
	<footer>

	</footer>
    <script>
        function logout(){
        let url = "{{ route('checkoutadmin') }}";

        document.location.href=url;
    }
    </script>

	
	<script type="text/javascript">
		window.onload = function () {
			
			var from_date = document.getElementById("from_date");
			var to_date = document.getElementById("to_date");
			if (from_date.value == ''){
				from_date.value = '2022-01-01';
			}
			if (to_date.value == ''){
				to_date.value = '2022-01-31';
			}

			var from_month = document.getElementById("from_month");
			var to_month = document.getElementById("to_month");
			if (from_month.value == ''){
				from_month.value = '2022-01';
			}
			if (to_month.value == ''){
				to_month.value = '2022-12';
			}

			if (document.getElementById("day_opt").checked){
				document.getElementById("statistic_date").style.display = "block";
				document.getElementById("statistic_month").style.display = "none";
				document.getElementById("statistic_year").style.display = "none";
			} else if (document.getElementById("month_opt").checked){
				document.getElementById("statistic_month").style.display = "block";
				document.getElementById("statistic_date").style.display = "none";
				document.getElementById("statistic_year").style.display = "none";
			} else if (document.getElementById("year_opt").checked){
				document.getElementById("statistic_year").style.display = "block";
				document.getElementById("statistic_date").style.display = "none";
				document.getElementById("statistic_month").style.display = "none";
			}
		};

		function ThongKeNgay(){
			document.getElementById("statistic_date").style.display = "block";
			document.getElementById("statistic_month").style.display = "none";
			document.getElementById("statistic_year").style.display = "none";
		}

		function ThongKeThang(month_radio){
			document.getElementById("statistic_month").style.display = "block";
			document.getElementById("statistic_date").style.display = "none";
			document.getElementById("statistic_year").style.display = "none";
		}

		function ThongKeNam(year_radio){
			document.getElementById("statistic_year").style.display = "block";
			document.getElementById("statistic_date").style.display = "none";
			document.getElementById("statistic_month").style.display = "none";
		}
	</script>

</body>
</html>
<script>
    Morris.Bar({
    element : 'chart',
    data:[<?php echo $chart_data; ?>],
    xkey:'date',
    ykeys:['profit'],
    labels:['Profit'],
    hideHover:'auto',
    stacked:true
});
</script>