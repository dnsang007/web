@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-sanpham')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Thương hiệu</label>
                                            <select name="thuonghieusanpham" class="form-control input-sm m-bot15">
                                                @foreach($thuonghieu_sp as $key => $thuonghieu)
                                                    <option value="{{$thuonghieu->idthuonghieu}}">{{$thuonghieu->tenthuonghieu}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Loại</label>
                                            <select name="loaisanpham" class="form-control input-sm m-bot15">
                                                @foreach($loai_sp as $key => $loai)
                                                    <option value="{{$loai->idloai}}">{{$loai->tenloai}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Dạng</label>
                                            <select name="dangsanpham" class="form-control input-sm m-bot15">
                                                @foreach($dang_sp as $key => $dang)
                                                    <option value="{{$dang->iddang}}">{{$dang->tendang}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Dung tích</label>
                                            <select name="dungtichsanpham" class="form-control input-sm m-bot15">
                                                @foreach($dungtich_sp as $key => $dungtich)
                                                    <option value="{{$dungtich->iddungtich}}">{{$dungtich->sodungtich}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                   

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" name="tensanpham" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                        <input type="file" name="anhsanpham" class="form-control" id="exampleInputEmail1" >
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Giá sản phẩm</label>
                                        <input type="number" min="1" name="giasanpham" class="form-control" id="exampleInputPassword1" placeholder="Giá sản phẩm" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Xuất xứ sản phẩm</label>
                                        <input type="text" class="form-control" name="xuatxusanpham" id="exampleInputPassword1" placeholder="Xuất xứ sản phẩm" required="">
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Trạng thái</label>
                                            <select name="trangthaisanpham" class="form-control input-sm m-bot15">
                                                <option value="0">Ẩn</option>
                                                <option value="1" selected="true">Hiện thị</option>
                                            
                                            </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                        <textarea style="resize: none" rows="5" class="form-control" name="motasanpham" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Số lượng tồn kho</label>
                                        <input type="number" min="0" class="form-control" name="soluongtonkho" id="exampleInputPassword1" placeholder="Số lượng tồn kho" required="">
                                    </div>
                                    
                                    <button type="submit" name="add_sanpham" class="btn btn-info">Thêm sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection