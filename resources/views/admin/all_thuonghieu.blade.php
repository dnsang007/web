@extends('admin_giaodien')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
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
            <th>ID Thương hiệu</th>
            <th>Tên thương hiệu</th>
            <th>Sửa|Xóa</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_thuonghieu as $key => $thuonghieu)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$thuonghieu->idthuonghieu}}</td>
            <td>{{$thuonghieu->tenthuonghieu}}</td>
            
            <td>
                <a href="{{URL::to('/edit-thuonghieu/'.$thuonghieu->idthuonghieu)}}" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không')" href="{{URL::to('/delete-thuonghieu/'.$thuonghieu->idthuonghieu)}}" class="active styling-edit">
                  <i class="fa fa-times text-danger text"></i>
                </a>
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