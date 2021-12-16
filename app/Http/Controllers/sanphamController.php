<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
session_start();

class sanphamController extends Controller
{
    public function add_sanpham()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
        return view('admin.add_sanpham')->with('thuonghieu_sp', $thuonghieu_sp)->with('loai_sp', $loai_sp)->with('dang_sp', $dang_sp)->with('dungtich_sp', $dungtich_sp);
    }
    public function all_sanpham()
    {
        $all_sanpham = DB::table('sanpham')
        ->join('thuonghieu','thuonghieu.idthuonghieu','=','sanpham.idthuonghieu') 
        ->join('loai','loai.idloai','=','sanpham.idloai') 
        ->join('dang','dang.iddang','=','sanpham.iddang') 
        ->join('dungtich','dungtich.iddungtich','=','sanpham.iddungtich') 
        ->orderby('sanpham.idsanpham','desc')->get();
        $manager_sanpham = view('admin.all_sanpham')->with('all_sanpham',$all_sanpham);
        return view('admin_giaodien')->with('admin.all_sanpham',$manager_sanpham);
    }
    public function save_sanpham(Request $request)
    {
        $data= array();
        $data['idthuonghieu'] = $request->thuonghieusanpham;
        $data['idloai'] = $request->loaisanpham;
        $data['iddang'] = $request->dangsanpham;
        $data['iddungtich'] = $request->dungtichsanpham;
        $data['tensanpham'] = $request->tensanpham;
        
        $data['giasanpham'] = $request->giasanpham;
        $data['xuatxu'] = $request->xuatxusanpham;
        $data['trangthai'] = $request->trangthaisanpham;
        $data['mota'] = $request->motasanpham;
        $data['soluongtonkho'] = $request->soluongtonkho;
        $get_image = $request->file('anhsanpham');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName(); //22
            $name_image = current(explode('.',$get_name_image)); 
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/sanpham', $new_image);
            $data['anhsanpham'] = $new_image;
            DB::table('sanpham')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect('/all-sanpham');
        }
        $data['anhsanpham'] = '';

        DB::table('sanpham')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect('/all-sanpham');
    }
    public function edit_sanpham($id_sanpham)
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

        $edit_sanpham = DB::table('sanpham')->where('idsanpham',$id_sanpham)->get();
        $manager_sanpham = view('admin.edit_sanpham')
        ->with('edit_sanpham',$edit_sanpham)
        ->with('thuonghieu_sp',$thuonghieu_sp)->with('loai_sp',$loai_sp)
        ->with('dang_sp',$dang_sp)->with('dungtich_sp',$dungtich_sp);

        return view('admin_giaodien')->with('admin.edit_sanpham',$manager_sanpham);
    }
    public function update_sanpham(Request $request, $id_sanpham)
    {
        $data= array();
        $data['idthuonghieu'] = $request->thuonghieusanpham;
        $data['idloai'] = $request->loaisanpham;
        $data['iddang'] = $request->dangsanpham;
        $data['iddungtich'] = $request->dungtichsanpham;
        $data['tensanpham'] = $request->tensanpham;
        
        $data['giasanpham'] = $request->giasanpham;
        $data['xuatxu'] = $request->xuatxusanpham;
        $data['trangthai'] = $request->trangthaisanpham;
        $data['mota'] = $request->motasanpham;
        $data['soluongtonkho'] = $request->soluongtonkho;
        
        $get_image = $request->file('anhsanpham');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName(); //22
            $name_image = current(explode('.',$get_name_image)); 
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/sanpham', $new_image);
            $data['anhsanpham'] = $new_image;
            DB::table('sanpham')->where('idsanpham', $id_sanpham)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect('/all-sanpham');
        }
        

        DB::table('sanpham')->where('idsanpham',$id_sanpham)->update($data);
        Session::put('message',' Cập nhật sản phẩm thành công');
        return Redirect::to('all-sanpham');
    }
    public function delete_sanpham($id_sanpham)
    {
        $chitiet_sp_id = DB::table('chitiethoadon')
        ->join('sanpham','sanpham.idsanpham','=','chitiethoadon.idsanpham') 
        ->where('chitiethoadon.idsanpham',$id_sanpham)->count();

        if($chitiet_sp_id==0){
        DB::table('sanpham')->where('idsanpham',$id_sanpham)->delete();
        Session::put('message',' Xóa sản phẩm thành công');
        return Redirect('/all-sanpham');
        }else{
            Session::put('message','Xóa sản phẩm không thành công');
            return Redirect('/all-sanpham');
        }
    }

    public function unactive_sanpham($id_sanpham)
    {
        DB::table('sanpham')->where('idsanpham',$id_sanpham)->update(['trangthai'=>1]);
        Session::put('message','kích hoạt sản phẩm thành công');
        return Redirect('/all-sanpham');
    }
    public function active_sanpham($id_sanpham)
    {
        DB::table('sanpham')->where('idsanpham',$id_sanpham)->update(['trangthai'=>0]);
        Session::put('message','không kích hoạt sản phẩm thành công');
        return Redirect('/all-sanpham');
    }

    //end Admin page

    public function show_sanphamsanpham()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
        $all_sp = DB::table('sanpham')->where('trangthai','1')->orderby('idsanpham','desc')->get();
        $all_banner = DB::table('banner')->orderby('idbanner','asc')->limit(2)->get();
        $banner = DB::table('banner');
        foreach($all_banner as $p)
        {
            $banner->whereNotIn('idbanner',[$p->idbanner]);
        }
        $result=$banner->limit(1)->get();
        $product_km = DB::table('sanpham')
        ->join('chitietkhuyenmai','sanpham.idsanpham','=','chitietkhuyenmai.idsanpham')
        ->join('khuyenmai','chitietkhuyenmai.idkhuyenmai','=','khuyenmai.idkhuyenmai')
        ->get();
        $time=Carbon::now('Asia/Ho_Chi_Minh');

        return view('pages.sanpham.sanpham_sanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('sanpham',$all_sp)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('product_km',$product_km)
        ->with('time',$time);
    }
    public function show_sanphamkhuyenmai()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

        $all_sp = DB::table('sanpham')
        ->join('chitietkhuyenmai','sanpham.idsanpham','=','chitietkhuyenmai.idsanpham')
        ->join('khuyenmai','chitietkhuyenmai.idkhuyenmai','=','khuyenmai.idkhuyenmai')
        ->get();
        $all_banner = DB::table('banner')->orderby('idbanner','asc')->limit(2)->get();
        $banner = DB::table('banner');
        foreach($all_banner as $p)
        {
            $banner->whereNotIn('idbanner',[$p->idbanner]);
        }
        $result=$banner->limit(1)->get();
        $product_km = DB::table('sanpham')
        ->join('chitietkhuyenmai','sanpham.idsanpham','=','chitietkhuyenmai.idsanpham')
        ->join('khuyenmai','chitietkhuyenmai.idkhuyenmai','=','khuyenmai.idkhuyenmai')
        ->get();
        $time=Carbon::now('Asia/Ho_Chi_Minh');

        return view('pages.sanpham.sanpham_khuyenmai')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('sanpham',$all_sp)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('product_km',$product_km)
        ->with('time',$time);
    }
    public function show_chitietsanpham($id_sanpham)
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
        $all_banner = DB::table('banner')->orderby('idbanner','asc')->limit(2)->get();
        $banner = DB::table('banner');
        foreach($all_banner as $p)
        {
            $banner->whereNotIn('idbanner',[$p->idbanner]);
        }
        $result=$banner->limit(1)->get();

        $chitiet_sanpham = DB::table('sanpham')
        ->join('thuonghieu','thuonghieu.idthuonghieu','=','sanpham.idthuonghieu') 
        ->join('loai','loai.idloai','=','sanpham.idloai') 
        ->join('dang','dang.iddang','=','sanpham.iddang') 
        ->join('dungtich','dungtich.iddungtich','=','sanpham.iddungtich') 
        ->where('sanpham.idsanpham',$id_sanpham)->get();
        foreach($chitiet_sanpham as $key => $a)
        {  
        $product_km = DB::table('sanpham')
            ->join('chitietkhuyenmai','sanpham.idsanpham','=','chitietkhuyenmai.idsanpham')
            ->join('khuyenmai','chitietkhuyenmai.idkhuyenmai','=','khuyenmai.idkhuyenmai')
            ->where('chitietkhuyenmai.idsanpham',$a->idsanpham)
            ->first();
        }
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        foreach($chitiet_sanpham as $key => $value)
        {  
            $id_thuonghieu = $value->idthuonghieu;
        }
        
        $tuongtu_sanpham = DB::table('sanpham')
        ->join('thuonghieu','thuonghieu.idthuonghieu','=','sanpham.idthuonghieu') 
        ->join('loai','loai.idloai','=','sanpham.idloai') 
        ->join('dang','dang.iddang','=','sanpham.iddang') 
        ->join('dungtich','dungtich.iddungtich','=','sanpham.iddungtich') 
        ->where('thuonghieu.idthuonghieu',$id_thuonghieu)->whereNotIn('sanpham.idsanpham',[$id_sanpham])->limit(3)->get();

        return view('pages.chitiet.chitietsanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('chitiet_sanpham',$chitiet_sanpham)
        ->with('tuongtu_sanpham',$tuongtu_sanpham)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('product_km',$product_km)
        ->with('time',$time);
    }    
}
