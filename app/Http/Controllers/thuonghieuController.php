<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class thuonghieuController extends Controller
{
    public function add_thuonghieu()
    {
        return view('admin.add_thuonghieu');
    }
    public function all_thuonghieu()
    {
        $all_thuonghieu = DB::table('thuonghieu')->get();
        $manager_thuonghieu = view('admin.all_thuonghieu')->with('all_thuonghieu',$all_thuonghieu);
        return view('admin_giaodien')->with('admin.all_thuonghieu',$manager_thuonghieu);
    }
    public function save_thuonghieu(Request $request)
    {
        $data= array();
        $data['tenthuonghieu'] = $request->tenthuonghieu;

        if($request->tenthuonghieu!=$request->tenthuonghieu){
            DB::table('thuonghieu')->insert($data);
            Session::put('message','Thêm thương hiệu sản phẩm thành công');
            return Redirect('/add-thuonghieu');
        }else{
            Session::put('message','Tên thương hiệu này đã tồn tại');
            return Redirect('/add-thuonghieu');
        }

        // DB::table('thuonghieu')->insert($data);
        // Session::put('message','Thêm thương hiệu sản phẩm thành công');
        // return Redirect('/add-thuonghieu');
    }
    public function edit_thuonghieu($id_thuonghieu)
    {
        $edit_thuonghieu = DB::table('thuonghieu')->where('idthuonghieu',$id_thuonghieu)->get();
        $manager_thuonghieu = view('admin.edit_thuonghieu')->with('edit_thuonghieu',$edit_thuonghieu);
        return view('admin_giaodien')->with('admin.edit_thuonghieu',$manager_thuonghieu);
    }
    public function update_thuonghieu(Request $request,$id_thuonghieu)
    {
        $data = array();
        $data['tenthuonghieu'] = $request->tenthuonghieu;
        
        DB::table('thuonghieu')->where('idthuonghieu',$id_thuonghieu)->update($data);
        Session::put('message',' Cập nhật thương hiệu sản phẩm thành công');
        return Redirect('/all-thuonghieu');
    }
    public function delete_thuonghieu($id_thuonghieu)
    {
        
        
        $thuonghieu_sp_id = DB::table('sanpham')
        ->join('thuonghieu','thuonghieu.idthuonghieu','=','sanpham.idthuonghieu') 
        ->where('sanpham.idthuonghieu',$id_thuonghieu)->count();

        if($thuonghieu_sp_id==0){
            DB::table('thuonghieu')->where('idthuonghieu',$id_thuonghieu)->delete();
            Session::put('message',' Xóa thương hiệu sản phẩm thành công');
            return Redirect('/all-thuonghieu');
        }else{
            Session::put('message','Xóa thương hiệu không thành công');
            return Redirect('/all-thuonghieu');
        }
       
    }
    //end Admin page

    public function show_thuonghieusanpham($id_thuonghieu)
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
        $thuonghieu_by_id = DB::table('sanpham')
        ->join('thuonghieu','thuonghieu.idthuonghieu','=','sanpham.idthuonghieu') 
        ->where('sanpham.idthuonghieu',$id_thuonghieu)->get();
        
        $tenthuonghieu = DB::table('thuonghieu')
        ->where('thuonghieu.idthuonghieu',$id_thuonghieu)
        ->limit(1)->get();

        return view('pages.sanpham.thuonghieu_sanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('thuonghieu_by_id',$thuonghieu_by_id)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('tenthuonghieu',$tenthuonghieu);
    }
    
}
