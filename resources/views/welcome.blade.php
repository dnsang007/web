<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Shop bán nước hoa</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0367747341</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> dh51701233@student.stu.edu.vn</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<!-- <div class="logo pull-left">
							<img src="{{('public/frontend/anh/logo.jpg')}}" height="100" alt="" />
						</div> -->
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<li><a href="#"><i class="fa fa-star"></i> Sản phẩm yêu thích</a></li>

								<?php
								$idkhachhang = Session::get('idkhachhang');
								$idgiohang = Session::get('idgiohang');
								if($idkhachhang != NULL && $idgiohang==NULL){
								?>
									<li><a href="{{URL::to('/show-checkout')}}"><i class="fa fa-lock"></i> Thanh toán</a></li>
								
								<?php 
								}elseif($idkhachhang !=NULL && $idgiohang!=NULL){
								?>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-lock"></i> Thanh toán</a></li>
								<?php
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Thanh toán</a></li>
								<?php
								}
								?>

								<li><a href="{{URL::to('/show-giohang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								

								<?php
								$idkhachhang = Session::get('idkhachhang');
								if($idkhachhang != NULL){
								?>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Tài khoản</a></li>
									<li><a href="{{URL::to('/login-dangxuat')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								
								<?php 
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php
								}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				
				<div class="row">
					<div class="col-sm-8.5">
						
						<div class="mainmenu pull-left">
							
							<ul class="nav navbar-nav collapse navbar-collapse">
							
								<li><a href="{{URL::to('/trangchu')}}" class="active">Trang chủ</a></li>
								
								
								<li><a href="{{URL::to('/sanpham-sanpham')}}" class="active">Sản phẩm mới</a></li>

								<li><a href="{{URL::to('/sanpham-khuyenmai')}}" class="active">Khuyến mãi</a></li>
								
								
								<li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										@foreach($thuonghieu as $key => $thuonghieu_sp)
                                        <li><a href="{{URL::to('/thuonghieu-sanpham/'.$thuonghieu_sp->idthuonghieu)}}">{{$thuonghieu_sp->tenthuonghieu}}</a></li> 
										@endforeach
                                    </ul>
                                </li> 

								<li class="dropdown"><a href="#">Loại<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($loai as $key => $loai_sp)
                                        <li><a href="{{URL::to('/loai-sanpham/'.$loai_sp->idloai)}}">{{$loai_sp->tenloai}}</a></li> 
										@endforeach
                                    </ul>
                                </li>

								<li class="dropdown"><a href="#">Dạng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($dang as $key => $dang_sp)
                                        <li><a href="{{URL::to('/dang-sanpham/'.$dang_sp->iddang)}}">{{$dang_sp->tendang}}</a></li> 
										@endforeach
                                    </ul>
                                </li>

								<li class="dropdown"><a href="#">Dung tich<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($dungtich as $key => $dungtich_sp)
                                        <li><a href="{{URL::to('/dungtich-sanpham/'.$dungtich_sp->iddungtich)}}">{{$dungtich_sp->sodungtich}}</a></li> 
										@endforeach
                                    </ul>
                                </li>

							</ul>
							
						</div>
					</div>
					<div class="col-sm-3.5">
						<form action="{{URL::to('/timkiem-sanpham')}}" method="POST" >
							{{csrf_field()}}
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"  />
								<input type="submit" style="color:#000" name="timkiem_item" class="btn btn-default btn-sm" value="Tìm kiếm " />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<!-- <ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol> -->
						
						<div class="carousel-inner">
							<div class="item active">
							@foreach($banner1 as $key=>$banner1)
							 <img style="width:80%;padding-left:10%;" src="{{URL::to('public/uploads/sanpham/'.$banner1->anhbanner)}}" alt="" />
							 @endforeach
							</div>
							

							@foreach($banner as $key=>$banner)
							<div class="item">
							<img style="width:80%;padding-left:10%;" src="{{URL::to('public/uploads/sanpham/'.$banner->anhbanner)}}" alt="" />
							</div>
							@endforeach
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						
						
							
						
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								@foreach($thuonghieu as $key => $thuonghieu_sp)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/thuonghieu-sanpham/'.$thuonghieu_sp->idthuonghieu)}}"> {{$thuonghieu_sp->tenthuonghieu}}</a></li>
									
								</ul>
								@endforeach
							</div>
						</div><!--/brands_products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Loại</h2>
							<div class="brands-name">
								@foreach($loai as $key => $loai_sp)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/loai-sanpham/'.$loai_sp->idloai)}}">{{$loai_sp->tenloai}}</a></li>
									
									
								</ul>
								@endforeach
							</div>
						</div>

						<div class="brands_products"><!--brands_products-->
							<h2>Dạng</h2>
							<div class="brands-name">
								@foreach($dang as $key => $dang_sp)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/dang-sanpham/'.$dang_sp->iddang)}}"> {{$dang_sp->tendang}}</a></li>
									
									
								</ul>
								@endforeach
							</div>
						</div>

						<div class="brands_products"><!--brands_products-->
							<h2>Dung tích</h2>
							<div class="brands-name">
								@foreach($dungtich as $key => $dungtich_sp)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/dungtich-sanpham/'.$dungtich_sp->iddungtich)}}"> {{$dungtich_sp->sodungtich}}</a></li>
									
								</ul>
								@endforeach
							</div>
						</div>
						
						
						
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<!--features_items-->
					
					<!--/category-tab-->
					
					<!--/recommended_items-->
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2>Shop bán nước hoa</h2>
							
						</div>
					</div>
					<div class="col-sm-7">
						
						
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Giới thiệu</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><p>Nước hoa đã trở thành đặc trưng của Việt 
									Nam.</p></li>
								<li><p>Số điện thoại: 0367747341<p></li>
								
								
							</ul>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Hỗ trợ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phương thức đặt hàng</a></li>
								<li><a href="#">Chính sách vận chuyển</a></li>
								<li><a href="#">Chính sách đổi trả</a></li>
								<li><a href="#">Chính sách bảo mật</a></li>
							</ul>
						</div>
					</div>
					
					
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2021 Shop bán nước hoa</p>
					
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>
</html>