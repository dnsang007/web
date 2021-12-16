@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa banner
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
                                @foreach($edit_banner as $key => $edit)
                                <form role="form" action="{{URL::to('/update-banner/'.$edit->idbanner)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên banner</label>
                                        <input type="text" name="tenbanner" class="form-control" id="exampleInputEmail1" value="{{$edit->tenbanner}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh banner</label>
                                        <input type="file" name="anhbanner" class="form-control" id="exampleInputEmail1" >
                                        <img src="{{URL::to('public/uploads/sanpham/'.$edit->anhbanner)}}" height="100" width="100">
                                    </div>

                                
                                    
                                    <button type="submit" name="edit_banner" class="btn btn-info">Sửa banner</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>

@endsection