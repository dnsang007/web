@extends('admin_giaodien')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa khuyen mai
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
                            @foreach($edit_khuyenmai as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-khuyenmai/'.$edit_value->idkhuyenmai)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khuyen mai</label>
                                    <input type="text" value="{{$edit_value->tenkhuyenmai}}" name="tenkhuyenmai" class="form-control" id="exampleInputEmail1" placeholder="Tên khuyen mai">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngay bat dau</label>
                                    <input type="datetime" value="{{$edit_value->ngaybatdau}}" name="ngaybatdau" class="form-control" id="exampleInputEmail1" placeholder="Ngay bat dau">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngay ket thuc</label>
                                    <input type="datetime" value="{{$edit_value->ngayketthuc}}" name="ngayketthuc" class="form-control" id="exampleInputEmail1" placeholder="Ngay ket thuc">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chiet khau</label>
                                    <input type="number" value="{{$edit_value->chietkhau}}" name="chietkhau" class="form-control" id="exampleInputEmail1" placeholder="Chiet khau">
                                </div>
                                
                                
                                <button type="submit" name="edit_khuyen mai" class="btn btn-info">Sửa khuyen mai</button>
                            </form>
                            </div>
                            @endforeach    
                        </div>
                    </section>

            </div>
@endsection