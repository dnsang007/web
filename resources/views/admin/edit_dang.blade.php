@extends('admin_giaodien')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa dạng sản phẩm
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
                            @foreach($edit_dang as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-dang/'.$edit_value->iddang)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên dạng</label>
                                    <input type="text" value="{{$edit_value->tendang}}" name="tendang" class="form-control" id="exampleInputEmail1" placeholder="Tên dạng">
                                </div>
                                
                                
                                <button type="submit" name="edit_dang" class="btn btn-info">Sửa dạng</button>
                            </form>
                            </div>
                            @endforeach    
                        </div>
                    </section>

            </div>
@endsection