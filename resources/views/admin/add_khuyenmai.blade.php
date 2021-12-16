@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-khuyenmai')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên khuyen mai</label>
                                        <input type="text" name="tenkhuyenmai" class="form-control" id="exampleInputEmail1" placeholder="Tên khuyen mai" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngay bat  dau (yyyy-mm-dd)</label>
                                        <input type="datetime-local" name="ngaybatdau" class="form-control" id="exampleInputEmail1" placeholder="Ngay bat dau" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngay ket thuc (yyyy-mm-dd)</label>
                                        <input type="datetime-local" name="ngayketthuc" class="form-control" id="exampleInputEmail1" placeholder="Ngay ket thuc" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chiet khau</label>
                                        <input type="number" min="1" max="100" name="chietkhau" class="form-control" id="exampleInputEmail1" placeholder="Chiet khau" required="">
                                    </div>

                                    
                                    <button type="submit" name="add_khuyenmai" class="btn btn-info">Thêm khuyenmai</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection