<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class giohangController extends Controller
{
    public function save_giohang(Request $request)
    {
        $id_sanpham = $request->sanpham_hidden;
        $soluong = $request->qty;

        $sanpham_info = DB::table('sanpham')->where('idsanpham',$id_sanpham)->first();
        $product_km = DB::table('sanpham')
        ->join('chitietkhuyenmai','sanpham.idsanpham','=','chitietkhuyenmai.idsanpham')
        ->join('khuyenmai','chitietkhuyenmai.idkhuyenmai','=','khuyenmai.idkhuyenmai')
        ->where('sanpham.idsanpham',$id_sanpham)
        ->first();

        
        
        $data['id'] = $sanpham_info->idsanpham;
        $data['qty'] = $soluong;
        $data['name'] = $sanpham_info->tensanpham;
        $data['price'] = $sanpham_info->giasanpham;
        if($product_km)
        {
            $data['price']=$product_km->giakhuyenmai;
        }
        else
        {
            $data['price']=$sanpham_info->giasanpham;   
        } 
        $data['weight'] = $sanpham_info->giasanpham;
        $data['options']['image'] = $sanpham_info->anhsanpham;
        Cart::add($data);
        // Cart::setGlobalTax(0); thuế sản phẩm
        //Cart::setGlobalDiscount(50); giảm giá trên sản phẩm
        return Redirect::to('/show-giohang');
        
    }
    public function show_giohang()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
        return view('pages.giohang.show_giohang')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp);
    }
    public function delete_giohang($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-giohang');
    }
    public function update_giohang_soluong(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->quantity_cart;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-giohang');
    }
}
