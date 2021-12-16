<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class loaiController extends Controller
{
    public function add_loai()
    {
        return view('admin.add_loai');
    }
    public function all_loai()
    {
        $all_loai = DB::table('loai')->get();
        $manager_loai = view('admin.all_loai')->with('all_loai',$all_loai);
        return view('admin_giaodien')->with('admin.all_loai',$manager_loai);
    }
    public function save_loai(Request $request)
    {
        $data= array();
        $data['tenloai'] = $request->tenloai;

        DB::table('loai')->insert($data);
        Session::put('message','Thêm dạng sản phẩm thành công');
        return Redirect('/add-loai');
    }
    public function edit_loai($id_loai)
    {
        $edit_loai = DB::table('loai')->where('idloai',$id_loai)->get();
        $manager_loai = view('admin.edit_loai')->with('edit_loai',$edit_loai);
        return view('admin_giaodien')->with('admin.edit_loai',$manager_loai);
    }
    public function update_loai(Request $request,$id_loai)
    {
        $data = array();
        $data['tenloai'] = $request->tenloai;
        
        DB::table('loai')->where('idloai',$id_loai)->update($data);
        Session::put('message',' Cập nhật loại sản phẩm thành công');
        return Redirect('/all-loai');
    }
    public function delete_loai($id_loai)
    {
        $loai_sp_id = DB::table('sanpham')
        ->join('loai','loai.idloai','=','sanpham.idloai') 
        ->where('sanpham.idloai',$id_loai)->count();

        if($loai_sp_id==0){
        DB::table('loai')->where('idloai',$id_loai)->delete();
        Session::put('message',' Xóa loại sản phẩm thành công');
        return Redirect('/all-loai');
        }else{
            Session::put('message',' Xóa loại sản phẩm không thành công');
            return Redirect('/all-loai');
        }
    }
    // end admin pages
    public function show_loaisanpham($id_loai)
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
        $loai_by_id = DB::table('sanpham')
        ->join('loai','loai.idloai','=','sanpham.idloai') 
        ->where('sanpham.idloai',$id_loai)->get();

        $tenloai = DB::table('loai')
        ->where('loai.idloai',$id_loai)
        ->limit(1)->get();

        return view('pages.sanpham.loai_sanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('loai_by_id',$loai_by_id)
        ->with('tenloai',$tenloai)
        ->with('banner',$all_banner)
        ->with('banner1',$result);
    }
}
