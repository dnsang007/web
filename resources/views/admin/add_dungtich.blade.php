@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm dung tích sản phẩm
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
                                <form role="form" action="{{URL::to('/save-dungtich')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số dung tích</label>
                                    <input type="text" name="sodungtich" class="form-control" id="exampleInputEmail1" placeholder="Số dung tích" required="">
                                </div>
                                
                                       
                                    
                                
                                <button type="submit" name="add_dungtich" class="btn btn-info">Thêm dung tích</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection