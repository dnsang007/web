@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm dạng sản phẩm
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
                                <form role="form" action="{{URL::to('/save-banner')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên banner</label>
                                    <input type="text" name="tenbanner" class="form-control" id="exampleInputEmail1" required="">
                                </div>

                               <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh banner</label>
                                        <input type="file"  name="anhbanner" class="form-control" id="exampleInputEmail1" required="">
                                </div>

                                <button type="submit" name="add_banner" class="btn btn-info">Thêm banner</button>
                            </form>
                        </div>
                    </section>

            </div>

@endsection