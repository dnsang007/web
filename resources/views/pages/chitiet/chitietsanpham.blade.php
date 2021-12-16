@extends('welcome')
@section('content')
@foreach($chitiet_sanpham as $key => $value)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('public/uploads/sanpham/'.$value->anhsanpham)}}" alt="" />
								
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    

								  <!-- Controls -->
								  
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								
								<h2>{{$value->tensanpham}}</h2>
								<p>Mã ID: {{$value->idsanpham}}</p>

								<p><b>Thương hiệu:</b> {{$value->tenthuonghieu}}</p>
								<p><b>Loại:</b> {{$value->tenloai}}</p>
								<p><b>Dạng:</b> {{$value->tendang}}</p>
								<p><b>Dung tích:</b> {{$value->sodungtich}}</p>
								<p><b>Số lượng:</b> còn {{$value->soluongtonkho}} sản phẩm</p>
								<p><b>Tình trạng:</b> 100%</p>
								
								<form action="{{URL::to('/save-giohang')}}" method="POST">
									{{ csrf_field() }}
								<span>
									
									<?php
										if($product_km && $product_km->idsanpham==$value->idsanpham)
										{ 
										?>
										<span>Giá:{{number_format($product_km->giakhuyenmai).'VND'}}</span>
										<?php 
										}else{
										?>
										<span>{{number_format($value->giasanpham).'VND'}}</span>
										<?php } ?>
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" value="1" />
									<input name="sanpham_hidden" type="hidden" min="1" value="{{$value->idsanpham}}" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ
									</button>
								</span>
								</form>

								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
								
								<li><a href="#tag" data-toggle="tab">Đánh giá</a></li>
								<li ><a href="#reviews" data-toggle="tab">Bình luận</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{{$value->mota}}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
@endforeach
                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm tương tự</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
								@foreach($tuongtu_sanpham as $key => $tuongtu_sp)
								<a href="{{URL::to('/chitiet-sanpham/'.$tuongtu_sp->idsanpham)}}">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<img src="{{URL::to('public/uploads/sanpham/'.$tuongtu_sp->anhsanpham)}}" height="200" alt="" />
											<h5>{{$tuongtu_sp->tensanpham}}</h5>
											
											<h5>{{number_format($tuongtu_sp->giasanpham)}} VNĐ </h5>
											
												</div>
											</div>
										</div>
									</div>
									</a>
									@endforeach
								</div>
								
							</div>
							 			
						</div>
					</div><!--/recommended_items-->

@endsection