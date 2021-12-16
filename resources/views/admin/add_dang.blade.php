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
                                <form role="form" action="{{URL::to('/save-dang')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên dạng</label>
                                    <input type="text" name="tendang" class="form-control" id="exampleInputEmail1" placeholder="Tên dạng" required="">
                                </div>
                                
                                       
                                    
                                
                                <button type="submit" name="add_dang" class="btn btn-info">Thêm dạng</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection