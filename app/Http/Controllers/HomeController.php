<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
session_start();

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

        $all_sp = DB::table('sanpham')->where('trangthai','1')->orderby('idsanpham','asc')->get();
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

        return view('pages.home')
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
    public function timkiem_sanpham(Request $request)
    {   
        $keywords = $request->keywords_submit;

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

        $timkiem_sp = DB::table('sanpham')
        ->where('tensanpham','like','%'.$keywords.'%')->get();

        return view('pages.sanpham.timkiem_sanpham')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('banner',$all_banner)
        ->with('banner1',$result)
        ->with('dungtich',$dungtich_sp)
        ->with('timkiem_sp',$timkiem_sp);
    }
}
