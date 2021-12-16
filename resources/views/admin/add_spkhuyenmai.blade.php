@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm khuyến mãi
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
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-sanphamkm')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Chương trình KM</label>
                                            <select name="tenkhuyenmai" class="form-control input-sm m-bot15">
                                                @foreach($khuyenmai as $key => $khuyenmai)
                                                    <option value="{{$khuyenmai->idkhuyenmai}}">{{$khuyenmai->tenkhuyenmai}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Sản phẩm khuyến mãi</label>
                                            <select name="tensanpham" class="form-control input-sm m-bot15">
                                                @foreach($sanpham as $key => $sanpham)
                                                    <option value="{{$sanpham->idsanpham}}">{{$sanpham->tensanpham}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                
                                    <button type="submit" name="add_sanphamkm" class="btn btn-info">Thêm sản phẩm KM</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection