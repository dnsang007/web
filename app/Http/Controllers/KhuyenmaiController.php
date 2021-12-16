<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
session_start();

class KhuyenmaiController extends Controller
{
    public function add_khuyenmai()
    {
        
        return view('admin.add_khuyenmai');
    }
    public function add_spkhuyenmai()
    {
        $khuyenmai = DB::table('khuyenmai')->orderby('idkhuyenmai','desc')->get();
        $sanpham = DB::table('sanpham')->orderby('idsanpham','desc')->get();
        return view('admin.add_spkhuyenmai')->with('khuyenmai', $khuyenmai)->with('sanpham', $sanpham);
    }
    public function all_khuyenmai()
    {
        $all_khuyenmai = DB::table('khuyenmai')->get();
        $manager_khuyenmai = view('admin.all_khuyenmai')->with('all_khuyenmai',$all_khuyenmai);
        return view('admin_giaodien')->with('admin.all_khuyenmai',$manager_khuyenmai);
    }
    public function save_khuyenmai(Request $request)
    {
        $time=Carbon::now();
        $data= array();
        $data['tenkhuyenmai'] = $request->tenkhuyenmai;
        $data['ngaybatdau'] = $request->ngaybatdau;
        $data['ngayketthuc'] = $request->ngayketthuc;
        $data['chietkhau'] = $request->chietkhau;
        if($time> $data['ngaybatdau'] )
        {
            Session::put('message','Ngày bắt đầu khuyến mãi sai');
            return Redirect('/add-khuyenmai');
        }
        else
        {
            if($data['ngaybatdau']>$data['ngayketthuc'])
            {
            Session::put('message','Ngày kết thúc khuyến mãi sai');
            return Redirect('/add-khuyenmai');
            }
            else
            {
                DB::table('khuyenmai')->insert($data);
                Session::put('message','Thêm khuyến mãi thành công');
                return Redirect('/add-khuyenmai');
            }
        }
      
    }
    public function save_sanphamkm(Request $request)
    {
        
        $sanphamkm=DB::table('khuyenmai')
        ->where('idkhuyenmai',$request->tenkhuyenmai)
        ->get();
        $sp=DB::table('sanpham')
        ->where('idsanpham',$request->tensanpham)
        ->get();
        // echo "<pre>";
        // print_r($sp);
        // echo "</pre>";
        $time=Carbon::now();
        $product_km1 = DB::table('chitietkhuyenmai')
        ->where('chitietkhuyenmai.idsanpham',$request->tensanpham)
        ->join('khuyenmai','khuyenmai.idkhuyenmai','=','chitietkhuyenmai.idkhuyenmai')
        ->get();
        // echo "<pre>";
        // print_r($product_km1);
        // echo "</pre>";
        $product_km=DB::table('chitietkhuyenmai')
        ->where('idkhuyenmai',$request->tenkhuyenmai)
        ->where('idsanpham',$request->tensanpham)
        ->count();
        
        // echo "<pre>";
        // print_r($product_km);
        // echo "</pre>";
        foreach($sanphamkm as $a)
        {
            foreach($sp as $p)
            {
                $data= array();
                $data['idkhuyenmai'] = $request->tenkhuyenmai;
                $data['idsanpham'] = $request->tensanpham;
                $data['giakhuyenmai'] = $p->giasanpham *((100-$a->chietkhau)/100);
                    if($product_km>0)
                    {
					Session::put('message','Sản phẩm đã có trong chương trình khuyến mãi này');
                    return Redirect('/add-spkhuyenmai');
                    }
                    else
                    {
                        foreach($product_km1 as $s)
                        {
                        if($s->ngayketthuc<$time)
                        {
                        DB::table('chitietkhuyenmai')->insert($data);
                        Session::put('message','Thêm sản phẩm khuyến mãi thành công');
                        return Redirect('/add-spkhuyenmai');
                        }
                        else
                        {
                            Session::put('message','Sản phẩm đã có trong một chương trình khuyến mãi khác');
                            return Redirect('/add-spkhuyenmai');
                        }
                        }
                    }
            }
        }
    }
    public function edit_khuyenmai($id_khuyenmai)
    {
        $edit_khuyenmai = DB::table('khuyenmai')->where('idkhuyenmai',$id_khuyenmai)->get();
        $manager_khuyenmai = view('admin.edit_khuyenmai')->with('edit_khuyenmai',$edit_khuyenmai);
        return view('admin_giaodien')->with('admin.edit_khuyenmai',$manager_khuyenmai);
    }
    public function update_khuyenmai(Request $request, $id_khuyenmai)
    {
        $data = array();
        $data['tenkhuyenmai'] = $request->tenkhuyenmai;
        $data['ngaybatdau'] = $request->ngaybatdau;
        $data['ngayketthuc'] = $request->ngayketthuc;
        $data['chietkhau'] = $request->chietkhau;
        
        DB::table('khuyenmai')->where('idkhuyenmai',$id_khuyenmai)->update($data);
        Session::put('message',' Cập nhật khuyen mai thành công');
        return Redirect('/all-khuyenmai');
    }
        
    public function delete_khuyenmai($id_khuyenmai)
    {
        DB::table('khuyenmai')->where('idkhuyenmai',$id_khuyenmai)->delete();
        Session::put('message',' Xóa khuyen mai thành công');
        return Redirect('/all-khuyenmai');
    }

    // public function show_chitietkhuyenmai($id_khuyenmai)
    // {
    //     $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
    //     $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
    //     $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
    //     $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();
        
    //     $thuonghieu_by_id = DB::table('sanpham')
    //     ->join('thuonghieu','thuonghieu.idthuonghieu','=','sanpham.idthuonghieu') 
    //     ->where('sanpham.idthuonghieu',$id_thuonghieu)->get();
        
    //     $tenthuonghieu = DB::table('thuonghieu')
    //     ->where('thuonghieu.idthuonghieu',$id_thuonghieu)
    //     ->limit(1)->get();

    //     return view('pages.sanpham.thuonghieu_sanpham')
    //     ->with('thuonghieu',$thuonghieu_sp)
    //     ->with('loai',$loai_sp)
    //     ->with('dang',$dang_sp)
    //     ->with('dungtich',$dungtich_sp)
    //     ->with('thuonghieu_by_id',$thuonghieu_by_id)
    //     ->with('tenthuonghieu',$tenthuonghieu);
    // }    
}
