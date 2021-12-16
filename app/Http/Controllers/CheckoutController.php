<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

       return view('pages.checkout.login_checkout')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp);
    }
    public function add_khachhang(Request $request)
    {
        $data = array();
        $data['tenkhachhang'] = $request->tenkhachhang;
        $data['sdt'] = $request->sdt;
        $data['mail'] = $request->mail;
        $data['diachi'] = $request->diachi;
        $data['taikhoan'] = $request->taikhoan;
        $data['matkhau'] = md5($request->matkhau);

        $idkhachhang = DB::table('khachhang')->insertGetId($data);
        Session::put('idkhachhang',$idkhachhang);
        Session::put('tenkhachhang',$request->tenkhachhang);
        return Redirect::to('/show-checkout');

    }
    public function show_checkout()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();    
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

       return view('pages.checkout.show_checkout')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp);
    }
    public function save_checkout(Request $request)
    {
        $data = array();
        $data['tengiohang'] = $request->tengiohang;
        $data['sdtgiohang'] = $request->sdtgiohang;
        $data['diachigiohang'] = $request->diachigiohang;
        $data['emailgiohang'] = $request->emailgiohang;
        $data['ghichugiohang'] = $request->ghichugiohang;
        

        $idgiohang = DB::table('giohang')->insertGetId($data);
        Session::put('idgiohang',$idgiohang);
        
        return Redirect::to('/payment');
    }
    public function payment()
    {
        $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
        $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
        $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
        $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

        return view('pages.checkout.payment')
        ->with('thuonghieu',$thuonghieu_sp)
        ->with('loai',$loai_sp)
        ->with('dang',$dang_sp)
        ->with('dungtich',$dungtich_sp);
    }

    public function order_place(Request $request)
    {
        //insert payment_method
        $data = array();
        $data['tenpayment'] = $request->payment_option;
        $data['trangthaipayment'] = 'Đang chờ xử lý';
        
        $idpayment = DB::table('payment')->insertGetId($data);

        //insert hoadon giohang
        $order_data = array();
        $order_data['idkhachhang'] = Session::get('idkhachhang');
        $order_data['idgiohang'] = Session::get('idgiohang');
        $order_data['idpayment'] = $idpayment;
        $order_data['tongtien'] = Cart::subtotal(0); //tongtien
        $order_data['trangthaihoadon'] = 'Đang chờ xử lý';

        $idhoadon = DB::table('hoadon')->insertGetId($order_data);

        //insert chitiethoadon giohang
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data = array();
            $order_d_data['idhoadon'] = $idhoadon;
            $order_d_data['idsanpham'] = $v_content->id;
            $order_d_data['tensanpham'] = $v_content->name;
            $order_d_data['giasanpham'] = $v_content->price;
            $order_d_data['soluong'] = $v_content->qty;

            DB::table('chitiethoadon')->insert($order_d_data);
        }
        if($data['tenpayment']==1)
        {
            echo 'Thanh toán bằng thẻ ATM';
        }else{
            Cart::destroy();
            $thuonghieu_sp = DB::table('thuonghieu')->orderby('idthuonghieu','desc')->get();
            $loai_sp = DB::table('loai')->orderby('idloai','desc')->get();
            $dang_sp = DB::table('dang')->orderby('iddang','desc')->get();
            $dungtich_sp = DB::table('dungtich')->orderby('iddungtich','desc')->get();

            return view('pages.checkout.tienmat_thanhtoan')
            ->with('thuonghieu',$thuonghieu_sp)
            ->with('loai',$loai_sp)
            ->with('dang',$dang_sp)
            ->with('dungtich',$dungtich_sp);
        }

        //return Redirect::to('/payment');
    }

    public function login_dangxuat()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request)
    {
        $taikhoan = $request->taikhoan;
        $matkhau = md5($request->matkhau);

        $result = DB::table('khachhang')->where('taikhoan',$taikhoan)->where('matkhau',$matkhau)->first();
        
        
        if($result==true)
        {  
            Session::put('idkhachhang',$result->idkhachhang);
            Session::put('tenkhachhang',$result->tenkhachhang);
            Session::put('sdt',$result->sdt);
            Session::put('mail',$result->mail);
            Session::put('diachi',$result->diachi);
            Session::put('message','Đăng nhập thành công');
            return Redirect::to('/show-checkout');
        }else{
            Session::put('message','Bạn nhập sai tài khoản hoặc mật khẩu');
            return Redirect::to('/login-checkout');
        }
        
    }
    
    //quanlydonhang
    public function quanly_hoadon()
    {
        $all_hoadon = DB::table('hoadon')
        ->join('khachhang','hoadon.idkhachhang','=','khachhang.idkhachhang') 
        ->select('hoadon.*','khachhang.tenkhachhang') 
        ->orderby('hoadon.idhoadon','asc')->get();
        $manager_hoadon = view('admin.quanly_hoadon')->with('all_hoadon',$all_hoadon);
        return view('admin_giaodien')->with('admin.manager_hoadon',$manager_hoadon);
    }
    public function view_chitiethoadon($orderId)
    {
        
        $order_by_id = DB::table('hoadon')
        ->join('khachhang','hoadon.idkhachhang','=','khachhang.idkhachhang') 
        ->join('giohang','hoadon.idgiohang','=','giohang.idgiohang') 
        ->join('chitiethoadon','hoadon.idhoadon','=','chitiethoadon.idhoadon') 
        ->select('hoadon.*','khachhang.*','giohang.*','chitiethoadon.*')
        ->where('chitiethoadon.idhoadon',$orderId)
        // ->where('chitiethoadon.tensanpham',$orderId)
        ->get();
        // echo '<pre>';
        // print_r($order_by_id);
        // echo '</pre>'; 
        
        $order_cc = DB::table('hoadon')
        ->join('khachhang','hoadon.idkhachhang','=','khachhang.idkhachhang') 
        ->join('giohang','hoadon.idgiohang','=','giohang.idgiohang') 
        ->join('chitiethoadon','hoadon.idhoadon','=','chitiethoadon.idhoadon') 
        ->select('hoadon.*','khachhang.*','giohang.*','chitiethoadon.*')
        ->where('chitiethoadon.idhoadon',$orderId)
        ->first();    
        $manager_hoadon_by_id = view('admin.view_chitiethoadon')->with('order_by_id',$order_by_id)
        ->with('order_cc',$order_cc);
        //dd($orderId);
         return view('admin_giaodien')->with('admin.view_chitiethoadon',$manager_hoadon_by_id);   
        //  dd($order_by_id);
        // dd($manager_hoadon_by_id);
       
    }

    //sửa trạng thaiđon hàng
    public function edit_hoadon($id_hoadon)
    {
        $khachhang_hh = DB::table('khachhang')->orderby('idkhachhang','desc')->get();
        $giohang_hh = DB::table('giohang')->orderby('idgiohang','desc')->get();
        $payment_hh = DB::table('payment')->orderby('idpayment','desc')->get();
        

        $edit_hoadon = DB::table('hoadon')->where('idhoadon',$id_hoadon)->get();
        $manager_edit_hoadon = view('admin.edit_hoadon')
        ->with('edit_hoadon',$edit_hoadon)
        ->with('khachhang_hh',$khachhang_hh)
        ->with('giohang_hh',$giohang_hh)
        ->with('payment_hh',$payment_hh);
        return view('admin_giaodien')->with('admin.manager_edit_hoadon',$manager_edit_hoadon);
    }
    public function update_hoadon(Request $request, $id_hoadon)
    {
        $data_hh = array();
        $data_hh['idkhachhang'] = $request->idkhachhang;
        $data_hh['idgiohang'] = $request->idgiohang;
        $data_hh['idpayment'] = $request->idpayment;
        $data_hh['tongtien'] = $request->tongtien;
        $data_hh['trangthaihoadon'] = $request->trangthaihoadon;
        
        DB::table('hoadon')->where('idhoadon',$id_hoadon)->update($data_hh);
        Session::put('message',' Cập nhật trạng thái thành công');
        return Redirect('/quanly-hoadon');
    }
    // public function delete_hoadon($id_hoadon)
    // {
    //     $hoadon_sp_id = DB::table('hoadon')
    //     ->where('hoadon.idhoadon',$id_hoadon)->select('hoadon.trangthaihoadon')->get();
        
    //     echo '<pre>';
    //     print_r($hoadon_sp_id);
    //     echo '</pre>';
        
    //     if($hoadon_sp_id=='Đang chờ xử lý'){
    //         DB::table('hoadon')->where('idhoadon',$id_hoadon)->delete();
    //         Session::put('message',' Xóa hóa đơn thành công');
    //         return Redirect('/quanly-hoadon');
    //     }else{
    //         Session::put('message',' Xóa hóa đơn không thành công');
    //         return Redirect('/quanly-hoadon');
    //     }
    // }
}
