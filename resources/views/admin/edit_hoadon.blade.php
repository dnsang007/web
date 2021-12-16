@extends('admin_giaodien')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa trạng thái sản phẩm
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message)
                            {
                                echo $message;
                                Session::put('message',null);
                            } 
                        ?>
                        <div class="panel-body">
                            @foreach($edit_hoadon as $key => $edit_hh)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-hoadon/'.$edit_hh->idhoadon)}}" method="post">
                                {{ csrf_field() }}
                                
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Khách hàng</label>
                                            <select name="idkhachhang" class="form-control input-sm m-bot15">
                                                @foreach($khachhang_hh as $key => $khachhang)
                                                    @if($khachhang->idkhachhang==$edit_hh->idkhachhang)
                                                    <option  selected value="{{$khachhang->idkhachhang}}">{{$khachhang->tenkhachhang}}</option>
                                                    @else
                                                    
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Giỏ hàng</label>
                                            <select name="idgiohang" class="form-control input-sm m-bot15">
                                                @foreach($giohang_hh as $key => $giohang)
                                                    @if($giohang->idgiohang==$edit_hh->idgiohang)
                                                    <option  selected value="{{$giohang->idgiohang}}">{{$giohang->tengiohang}}</option>
                                                    @else
                                                    
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Thanh toán</label>
                                            <select name="idpayment" class="form-control input-sm m-bot15">
                                                @foreach($payment_hh as $key => $payment)
                                                    @if($payment->idpayment==$edit_hh->idpayment)
                                                    <option selected value="{{$payment->idpayment}}">{{$payment->tenpayment}}</option>
                                                    @else
                                                    
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tổng tiền</label>
                                    <input type="text" readonly value="{{$edit_hh->tongtien}}" name="tongtien" class="form-control" id="exampleInputEmail1" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <input type="text" value="{{$edit_hh->trangthaihoadon}}" name="trangthaihoadon" class="form-control" id="exampleInputEmail1" >
                                </div>
                                
                                
                                <button type="submit" name="edit_hoadon" class="btn btn-info">Sửa trạng thái</button>
                            </form>
                            </div>
                            @endforeach    
                        </div>
                    </section>

            </div>
@endsection