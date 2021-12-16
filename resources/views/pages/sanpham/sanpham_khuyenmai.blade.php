@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm khuyến mãi</h2>
						@foreach($sanpham as $key => $sanpham_sp)
						<a href="{{URL::to('/chitiet-sanpham/'.$sanpham_sp->idsanpham)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/sanpham/'.$sanpham_sp->anhsanpham)}}" height="200" alt="" />
											<h5>{{$sanpham_sp->tensanpham}}</h5>
											
											<h5>{{number_format($sanpham_sp->giasanpham)}} VNĐ</h5>
											
											
											@foreach ($product_km as $a )
									@if($a->idsanpham == $sanpham_sp->idsanpham && $time < $a->ngayketthuc)
									<h4 style="color: red">Giá KM:  {{number_format($a->giakhuyenmai).' '.'VNĐ'}}</h3>
								
										
										@endif
									@endforeach
											<!-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> -->
										</div>

										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Sản phẩm yêu thích</a></li>
										
									</ul>
								</div>
							</div>
							
						</div>
						</a>
						@endforeach
</div> <!--features_items-->

         
@endsection
