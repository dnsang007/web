@extends('admin_giaodien')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa thương hiệu sản phẩm
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
                            @foreach($edit_thuonghieu as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-thuonghieu/'.$edit_value->idthuonghieu)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_value->tenthuonghieu}}" name="tenthuonghieu" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                
                                
                                <button type="submit" name="edit_thuonghieu" class="btn btn-info">Sửa thương hiệu</button>
                            </form>
                            </div>
                            @endforeach    
                        </div>
                    </section>

            </div>
@endsection