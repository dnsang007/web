@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						@foreach($sodungtich as $key => $dl_so)
						<h2 class="title text-center">{{$dl_so->sodungtich}}</h2>
						@endforeach
						@foreach($dungtich_by_id as $key => $sanpham_sp)
						<a href="{{URL::to('/chitiet-sanpham/'.$sanpham_sp->idsanpham)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/sanpham/'.$sanpham_sp->anhsanpham)}}" height="200" alt="" />
											<h5>{{$sanpham_sp->tensanpham}}</h5>
											
											<h5>{{number_format($sanpham_sp->giasanpham)}} VNĐ </h5>
											
											
											
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
