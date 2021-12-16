@extends('welcome')
@section('content')

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
							<?php
							$message = Session::get('message');
							if($message)
							{
								echo '<span class="text-alert">'.$message.'</span>';
								Session::put('message',null);
							} 
							?>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="taikhoan" placeholder="Tài khoản" required=""/>
							<input type="password" name="matkhau" placeholder="Mật khẩu" required=""/>
							
							<input type="submit" value="Đăng nhập" name="login">
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký mới</h2>
						<form action="{{URL::to('/add-khachhang')}}" method="POST" >
                            {{ csrf_field() }}
							<input type="text"  name="tenkhachhang" placeholder="Tên khách hàng" required=""/>
							<input type="text" pattern="(\+84|0)\d{9}" title="Nhập số điện thoại 10 số" name="sdt" placeholder="Số điện thoại" required=""/>
                            <input type="email" name="mail" placeholder="email" required=""/>
                            <input type="text" name="diachi" placeholder="Địa chỉ" required=""/>
                            <input type="text" name="taikhoan" placeholder="Tài khoản" required=""/>
							<input type="password" name="matkhau" placeholder="Mật khẩu" required=""/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection