<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class dungtichController extends Controller
{
    public function add_dungtich()
    {
        return view('admin.add_dungtich');
    }
    public function all_dungtich()
    {
        $all_dungtich = DB::table('dungtich')->get();
        $manager_dungtich = view('admin.all_dungtich')->with('all_dungtich',$all_dungtich);
        return view('admin_giaodien')->with('admin.all_dungtich',$manager_dungtich);
    }
    public function save_dungtich(Request $request)
    {
        $data= array();
        $data['sodungtich'] = $request->sodungtich;

        DB::table('dungtich')->insert($data);
        Session::put('message','Thêm dung tích sản phẩm thành công');
        return Redirect('/add-dungtich');
    }
    public function edit_dungtich($id_dungtich)
    {
        $edit_dungtich = DB::table('dungtich')->where('iddungtich',$id_dungtich)->get();
        $manager_dungtich = view('admin.edit_dungtich')->with('edit_dungtich',$edit_dungtich);
        return view('admin_giaodien')->with('admin.edit_dungtich',$manager_dungtich);
    }
    public function update_dungtich(Request $request,$id_dungtich)
    {
        $data = array();
        $data['sodungtich'] = $request->sodungtich;
        
        DB::table('dungtich')->where('iddungtich',$id_dungtich)->update($data);
        Session::put('message',' Cập nhật dung tích sản phẩm thành công');
        return Redirect('/all-dungtich');
    }
    public function delete_dungtich($id_dungtich)
    {
        $dungtich_sp_id = DB::table('sanpham')
        ->join('dungtich','dungtich.iddungtich','=','sanpham.iddungtich') 
        ->where('sanpham.iddungtich',$id_dungtich)->count();

        if($dungtich_sp_id==0){
        DB::table('dungtich')->where('iddungtich',$id_dungtich)->delete();
        Session::put('message',' Xóa dung tích sản phẩm thành công');
        return Redirect('/all-dungtich');
        }else{
            Session::put('message',' Xóa dung tích sản phẩm không thành công');
        return Redirect('/all-dungtich');
        }
    }
    // end admin pages
    public function show_dungtichsanpham($id_dungtich)
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
        $dungtich_by_id = DB::table('sanpham')
        ->join('dungtich','dungtich.iddungtich','=','sanpham.iddungtich') 
        ->where('sanpham.iddungtich',$id_dungtich)->get();

        $sodungtich = DB::table('dungtich')
        ->where('dungtich.iddungtich',$id_dungtich)
        ->limit(1)->get();

        return view('pages.sanpham.dungtich_sanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp)
        ->with('dungtich_by_id',$dungtich_by_id)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('sodungtich',$sodungtich);
    }
}
