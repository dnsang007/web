@extends('welcome')
@section('content')

<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<?php
							$message = Session::get('message');
							if($message)
							{
								echo '<span class="text-alert">'.$message.'</span>';
								Session::put('message',null);
							} 
							?>
			

			

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout')}}" method="POST">
									{{ csrf_field() }}
									<input type="text" name="tengiohang" placeholder="Tên khách hàng" value="{{Session::get('tenkhachhang')}}" required="">
									<input type="text" pattern="(\+84|0)\d{9}" title="Nhập số điện thoại 10 số" name="sdtgiohang" placeholder="Số điện thoại" value="{{Session::get('sdt')}}" required="">
                                    <input type="text" name="diachigiohang" placeholder="Địa chỉ" value="{{Session::get('diachi')}}" required="">
									<input type="email" name="emailgiohang" placeholder="email" value="{{Session::get('mail')}}" required="">
									<textarea name="ghichugiohang"  placeholder="Ghi chú đơn hàng" rows="16">Ghi chú đơn hàng: </textarea>

									<input type="submit" value="Đặt hàng" name="send_order" class="btn btn-primary btn-sm">
								</form>
							</div>
							
						</div>
					</div>
											
				</div>
			</div>
			
            
			
			
		</div>
	</section> <!--/#cart_items-->

@endsection