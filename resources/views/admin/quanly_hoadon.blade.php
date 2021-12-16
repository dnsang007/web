@extends('admin_giaodien')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
                <?php
                
                $content = Cart::content();
            
                ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>ID đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Xem|Sửa</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_hoadon as $key => $hoadon)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$hoadon->idhoadon}}</td>
            <td>{{$hoadon->tenkhachhang}}</td>
            <td>{{$hoadon->tongtien}}</td>
            <td>{{$hoadon->trangthaihoadon}}</td>
            
            <td>
                
                <a href="{{URL::to('/view-chitiethoadon/'.$hoadon->idhoadon)}}" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-calendar-check-o text-active"></i>
                </a>
                <a href="{{URL::to('/edit-hoadon/'.$hoadon->idhoadon)}}" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-active"></i>
                </a>
                <!-- <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không')" href="{{URL::to('/delete-hoadon/'.$hoadon->idhoadon)}}" class="active styling-edit">
                  <i class="fa fa-times text-danger text"></i>
                </a> -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
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
    </footer>
  </div>
</div>
@endsection