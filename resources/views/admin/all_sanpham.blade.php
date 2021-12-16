@extends('admin_giaodien')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê loại sản phẩm
    </div>
    <?php
                            $message = Session::get('message');
                            if($message)
                            {
                                echo $message;
                                Session::put('message',null);
                            } 
                        ?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Id sản phẩm</th>
            <th>Id thương hiệu</th>
            <th>Id loại</th>
            <th>Id dạng</th>
            <th>id dung tích</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Xuất xứ</th>
            <th>Trạng thái</th>
            <!-- <th>Mô tả</th> -->
            <th>Số lượng tồn kho</th>
            <th>Sửa|Xóa</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_sanpham as $key => $sanpham)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$sanpham->idsanpham}}</td>
            <td>{{$sanpham->tenthuonghieu}}</td>
            <td>{{$sanpham->tenloai}}</td>
            <td>{{$sanpham->tendang}}</td>
            <td>{{$sanpham->sodungtich}}</td>
            <td>{{$sanpham->tensanpham}}</td>
            <td><img src="public/uploads/sanpham/{{$sanpham->anhsanpham}}" height="100" width="100" ></td>
            <td>{{$sanpham->giasanpham}}</td>
            <td>{{$sanpham->xuatxu}}</td>

            <td><span class="text-ellipsis">
              <?php 
                if($sanpham->trangthai==0){
                  ?>
                  <a href="{{(URL::to('/unactive-sanpham/'.$sanpham->idsanpham))}}"><span class="fa-thumb-styling fa fa-thumbs-down"></psan></a>
                  <?php
                }else{
                  ?>
                  <a href="{{(URL::to('/active-sanpham/'.$sanpham->idsanpham))}}"><span class="fa-thumb-styling fa fa-thumbs-up"></psan></a>
                  <?php
                }
              ?>        
            </span></td>

            <!-- <td>{{$sanpham->mota}}</td> -->
            <td>{{$sanpham->soluongtonkho}}</td>

            
            <td>
                <a href="{{URL::to('/edit-sanpham/'.$sanpham->idsanpham)}}" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không')" href="{{URL::to('/delete-sanpham/'.$sanpham->idsanpham)}}" class="active styling-edit">
                  <i class="fa fa-times text-danger text"></i>
                </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer> -->
  </div>
</div>
@endsection