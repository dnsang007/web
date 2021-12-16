@extends('admin_giaodien')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa dung tích sản phẩm
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
                            @foreach($edit_dungtich as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-dungtich/'.$edit_value->iddungtich)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số dung tích</label>
                                    <input type="text" value="{{$edit_value->sodungtich}}" name="sodungtich" class="form-control" id="exampleInputEmail1" placeholder="Số dung tích">
                                </div>
                                
                                
                                <button type="submit" name="edit_dungtich" class="btn btn-info">Sửa dung tích</button>
                            </form>
                            </div>
                            @endforeach    
                        </div>
                    </section>

            </div>
@endsection