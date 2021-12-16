<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class dangController extends Controller
{
    public function AuthLogin()
    {
        
        $idadmin = Session::get('idadmin');
        if($idadmin==0)
        {
            return Redirect::to('admin')->send();
        }else{
            return Redirect::to('giaodien');
        }
    }
    public function add_dang()
    {
        $this->AuthLogin();
        return view('admin.add_dang');
    }
    public function all_dang()
    {
        
        $all_dang = DB::table('dang')->get();
        $manager_dang = view('admin.all_dang')->with('all_dang',$all_dang);
        return view('admin_giaodien')->with('admin.all_dang',$manager_dang);
    }
    public function save_dang(Request $request)
    {
        $data= array();
        $data['tendang'] = $request->tendang;

        DB::table('dang')->insert($data);
        Session::put('message','Thêm dạng sản phẩm thành công');
        return Redirect('/add-dang');
    }
    public function edit_dang($id_dang)
    {
        
        $edit_dang = DB::table('dang')->where('iddang',$id_dang)->get();
        $manager_dang = view('admin.edit_dang')->with('edit_dang',$edit_dang);
        return view('admin_giaodien')->with('admin.edit_dang',$manager_dang);
    }
    public function update_dang(Request $request,$id_dang)
    {
        $data = array();
        $data['tendang'] = $request->tendang;
        
        DB::table('dang')->where('iddang',$id_dang)->update($data);
        Session::put('message',' Cập nhật dạng sản phẩm thành công');
        return Redirect('/all-dang');
    }
    public function delete_dang($id_dang)
    {
        $dang_sp_id = DB::table('sanpham')
        ->join('dang','dang.iddang','=','sanpham.iddang') 
        ->where('sanpham.iddang',$id_dang)->count();

        if($dang_sp_id==0){
        DB::table('dang')->where('iddang',$id_dang)->delete();
        Session::put('message',' Xóa dạng sản phẩm thành công');
        return Redirect('/all-dang');
        }else{
            Session::put('message',' Xóa dạng sản phẩm không thành công');
        return Redirect('/all-dang');
        }
    }
    // end admin pages
    public function show_dangsanpham($id_dang)
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
        $dang_by_id = DB::table('sanpham')
        ->join('dang','dang.iddang','=','sanpham.iddang') 
        ->where('sanpham.iddang',$id_dang)->get();
        $all_banner = DB::table('banner')->orderby('idbanner','asc')->limit(2)->get();
        $banner = DB::table('banner');
        foreach($all_banner as $p)
        {
            $banner->whereNotIn('idbanner',[$p->idbanner]);
        }
        $result=$banner->limit(1)->get();
        $tendang = DB::table('dang')
        ->where('dang.iddang',$id_dang)
        ->limit(1)->get();

        return view('pages.sanpham.dang_sanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('dang_by_id',$dang_by_id)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('tendang',$tendang);
    }
}
