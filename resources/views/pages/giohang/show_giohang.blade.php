@extends('welcome')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
                <?php
                
                $content = Cart::content();
            
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<img src="{{URL::to('public/uploads/sanpham/'.$v_content->options->image)}}" height="90" width="90" alt="">
							</td>
							<td class="cart_description" >
								<h4>{{$v_content->name}}</h4>
								
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price)}} VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">	
									
                                    <form action="{{URL::to('/update-giohang-soluong')}}" method="POST" >            
                                        {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="number" min="1"  name="quantity_cart" value="{{$v_content->qty}}" >
                                    <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="btn btn-default btn-sm" >
                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm" >

                                    </form>        

								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                    <?php 
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal).' '.'VNĐ';
                                    ?>


                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-giohang/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach
						
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

    <section id="do_action">
		<div class="container">
			
			<div class="row">
				
				</div> 
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{Cart::subtotal(0)}} VNĐ</span></li>
							<!-- <li>Thuế <span>{{Cart::tax(0)}} VNĐ</span></li> -->
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::subtotal(0)}} VNĐ</span></li>
						</ul>
						<?php
								$idkhachhang = Session::get('idkhachhang');
								if($idkhachhang != NULL && Cart::count()>0){
								?>
									
								<a class="btn btn-default check_out" href="{{URL::to('/show-checkout')}}">Thanh toán</a>
								<?php 
								}elseif($idkhachhang != NULL && Cart::count()==0){
									?>
									<a class="btn btn-default check_out" href="{{URL::to('/show-giohang')}}">Thanh toán</a>
									<?php
								}
								else{
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Tiến hành thanh toán</a>
								
								<?php
								}
								?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection