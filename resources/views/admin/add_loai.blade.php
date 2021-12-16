@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm loại sản phẩm
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
                                <form role="form" action="{{URL::to('/save-loai')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại</label>
                                    <input type="text" name="tenloai" class="form-control" id="exampleInputEmail1" placeholder="Tên loại" required="">
                                </div>
                                
                                       
                                    
                                
                                <button type="submit" name="add_loai" class="btn btn-info">Thêm loại</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection