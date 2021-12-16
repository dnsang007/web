<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
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
    public function index()
    {
        return view('admin_trangdangnhap');
    }
    public function admin_giaodien()
    {
        $this->AuthLogin();
        return view('admin.giaodien');
    }
    public function giaodien(Request $request)
    {
        
        $taikhoan = $request->taikhoan;
        $matkhau = md5($request->matkhau);

        $result = DB::table('admin')->where('taikhoan',$taikhoan)->where('matkhau',$matkhau)->first();
        if($result==true)
        {
            Session::put('taikhoan',$result->taikhoan);
            Session::put('idadmin',$result->idadmin);
            return view('admin.giaodien');
        }else{
            Session::put('message','Bạn nhập sai tài khoản hoặc mật khẩu');
            return view('admin_trangdangnhap');
        }
    }
    public function dangxuat(Request $request)
    {
        
        Session::put('taikhoan',null);
        Session::put('idadmin',null);
        return Redirect::to('/admin');
    }
}
