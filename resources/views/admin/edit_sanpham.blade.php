@extends('admin_giaodien')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa sản phẩm
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
                                @foreach($edit_sanpham as $key => $edit)
                                <form role="form" action="{{URL::to('/update-sanpham/'.$edit->idsanpham)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Thương hiệu</label>
                                            <select name="thuonghieusanpham" class="form-control input-sm m-bot15">
                                                @foreach($thuonghieu_sp as $key => $thuonghieu)
                                                    @if($thuonghieu->idthuonghieu==$edit->idthuonghieu)
                                                    <option selected value="{{$thuonghieu->idthuonghieu}}">{{$thuonghieu->tenthuonghieu}}</option>
                                                    @else
                                                    <option value="{{$thuonghieu->idthuonghieu}}">{{$thuonghieu->tenthuonghieu}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Loại</label>
                                            <select name="loaisanpham" class="form-control input-sm m-bot15">
                                                @foreach($loai_sp as $key => $loai)
                                                    @if($loai->idloai==$edit->idloai)
                                                    <option selected value="{{$loai->idloai}}">{{$loai->tenloai}}</option>
                                                    @else
                                                    <option value="{{$loai->idloai}}">{{$loai->tenloai}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Dạng</label>
                                            <select name="dangsanpham" class="form-control input-sm m-bot15">
                                                @foreach($dang_sp as $key => $dang)
                                                    @if($dang->iddang==$edit->iddang)
                                                    <option selected value="{{$dang->iddang}}">{{$dang->tendang}}</option>
                                                    @else
                                                    <option value="{{$dang->iddang}}">{{$dang->tendang}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Dung tích</label>
                                            <select name="dungtichsanpham" class="form-control input-sm m-bot15">
                                                @foreach($dungtich_sp as $key => $dungtich)
                                                    @if($dungtich->iddungtich==$edit->iddungtich)
                                                    <option selected value="{{$dungtich->iddungtich}}">{{$dungtich->sodungtich}}</option>
                                                    @else
                                                    <option value="{{$dungtich->iddungtich}}">{{$dungtich->sodungtich}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                   

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" name="tensanpham" class="form-control" id="exampleInputEmail1" value="{{$edit->tensanpham}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                        <input type="file" name="anhsanpham" class="form-control" id="exampleInputEmail1" >
                                        <img src="{{URL::to('public/uploads/sanpham/'.$edit->anhsanpham)}}" height="100" width="100">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Giá sản phẩm</label>
                                        <input type="text" name="giasanpham" class="form-control" id="exampleInputPassword1" value="{{$edit->giasanpham}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Xuất xứ sản phẩm</label>
                                        <input type="text" class="form-control" name="xuatxusanpham" id="exampleInputPassword1" value="{{$edit->xuatxu}}">
                                    </div>
                                    <div class="form-group">
                                        <label  for="exampleInputPassword1">Trạng thái</label>
                                            <select name="trangthaisanpham" class="form-control input-sm m-bot15" value="{{$edit->trangthai}}">
                                                <option value="0">Ẩn</option>
                                                <option value="1" selected="true">Hiện thị</option>
                                            
                                            </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                        <textarea style="resize: none" rows="5" class="form-control" name="motasanpham" id="exampleInputPassword1" >{{$edit->mota}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Số lượng tồn kho</label>
                                        <input type="text" class="form-control" name="soluongtonkho" id="exampleInputPassword1" value="{{$edit->soluongtonkho}}">
                                    </div>
                                    
                                    <button type="submit" name="edit_sanpham" class="btn btn-info">Sửa sản phẩm</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>

@endsection