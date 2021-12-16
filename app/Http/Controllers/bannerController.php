<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
session_start();
class bannerController extends Controller
{
    public function add_banner()
    {
        return view('admin.add_banner');
    }
    public function all_banner()
    {
        $all_banner = DB::table('banner')
        ->orderby('banner.idbanner','desc')->get();
        $manager_banner = view('admin.all_banner')->with('all_banner',$all_banner);
        return view('admin_giaodien')->with('admin.all_banner',$manager_banner);
    }
    public function save_banner(Request $request)
    {
        $data1= array();
        $data1['tenbanner'] = $request->tenbanner;
        $get_image1 = $request->file('anhbanner');
        if($get_image1)
        {
            $get_name_image = $get_image1->getClientOriginalName(); //22
            $name_image = current(explode('.',$get_name_image)); 
            $new_image = $name_image.rand(0,99).'.'.$get_image1->getClientOriginalExtension();
            $get_image1->move('public/uploads/sanpham', $new_image);
            $data1['anhbanner'] = $new_image;
            DB::table('banner')->insert($data1);
            Session::put('message','Thêm banner thành công');
            return Redirect('/all-banner');
        }
        $data1['anhbanner'] = '';

        DB::table('banner')->insert($data1);
        Session::put('message','Thêm banner thành công');
        return Redirect('/add-banner');
    }
    public function edit_banner($id_banner)
    {
        $edit_banner = DB::table('banner')->where('idbanner',$id_banner)->get();
        $manager_banner = view('admin.edit_banner')->with('edit_banner',$edit_banner);
        return view('admin_giaodien')->with('admin.edit_banner',$manager_banner);
    }
    public function update_banner(Request $request,$id_banner)
    {
        $data= array();
       
        $data['tenbanner'] = $request->tenbanner;
        $get_image = $request->file('anhbanner');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName(); //22
            $name_image = current(explode('.',$get_name_image)); 
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/sanpham', $new_image);
            $data['anhbanner'] = $new_image;
            DB::table('banner')->where('idbanner', $id_banner)->update($data);
            Session::put('message','Cập nhật banner thành công');
            return Redirect('/all-banner');
        }
        

        DB::table('banner')->where('idbanner',$id_banner)->update($data);
        Session::put('message',' Cập nhật banner thành công');
        return Redirect::to('all-banner');
    }
    public function delete_banner($id_banner)
    {
        DB::table('banner')->where('idbanner',$id_banner)->delete();
        Session::put('message',' Xóa banner thành công');
        return Redirect('/all-banner');
    }
    // end admin pages
    public function show_loaisanpham($id_loai)
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
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
        ->with('tenloai',$tenloai);
    }
}
