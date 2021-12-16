@extends('admin_giaodien')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa loại sản phẩm
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
                            @foreach($edit_loai as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-loai/'.$edit_value->idloai)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại</label>
                                    <input type="text" value="{{$edit_value->tenloai}}" name="tenloai" class="form-control" id="exampleInputEmail1" placeholder="Tên loại">
                                </div>
                                
                                
                                <button type="submit" name="edit_loai" class="btn btn-info">Sửa loại</button>
                            </form>
                            </div>
                            @endforeach    
                        </div>
                    </section>

            </div>
@endsection