<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//-------------NGUOIDUNG
Route::get('/', 'HomeController@index') ;
Route::get('/trangchu', 'HomeController@index');

//timkiem_sanpham
Route::post('/timkiem-sanpham', 'HomeController@timkiem_sanpham');

//show-sanpham
Route::get('/thuonghieu-sanpham/{id_thuonghieu}', 'thuonghieuController@show_thuonghieusanpham');
Route::get('/loai-sanpham/{id_loai}', 'loaiController@show_loaisanpham');
Route::get('/dang-sanpham/{id_dang}', 'dangController@show_dangsanpham');
Route::get('/dungtich-sanpham/{id_dungtich}', 'dungtichController@show_dungtichsanpham');
Route::get('/sanpham-sanpham', 'sanphamController@show_sanphamsanpham');
Route::get('/sanpham-khuyenmai', 'sanphamController@show_sanphamkhuyenmai');

//show-chitiet-sanpham
Route::get('/chitiet-sanpham/{id_sanpham}', 'sanphamController@show_chitietsanpham');

//giohang
Route::post('/save-giohang', 'giohangController@save_giohang');
Route::get('/show-giohang', 'giohangController@show_giohang');
Route::get('/delete-giohang/{rowId}', 'giohangController@delete_giohang');
Route::post('/update-giohang-soluong', 'giohangController@update_giohang_soluong');

//checkout dangnhapkhachhang
Route::get('/login-checkout', 'CheckoutController@login_checkout');//trang đăng nhập
Route::post('/add-khachhang', 'CheckoutController@add_khachhang'); //hàm đăng ký khách hàng
Route::get('/show-checkout', 'CheckoutController@show_checkout'); //giaodien đăng nhập vs đkýad
Route::post('/save-checkout', 'CheckoutController@save_checkout'); //ham thanh toán
Route::get('/login-dangxuat', 'CheckoutController@login_dangxuat'); // dăng xuất
Route::post('/login-customer', 'CheckoutController@login_customer');//ham đăng nhập
Route::get('/payment', 'CheckoutController@payment'); // dăng xuất
Route::post('/order-place', 'CheckoutController@order_place');//ham thanhtoán(đặt hàng)

//quanlydonhang
Route::get('/quanly-hoadon', 'CheckoutController@quanly_hoadon');
Route::get('/view-chitiethoadon/{orderId}', 'CheckoutController@view_chitiethoadon');//view qlđonhang
Route::get('/edit-hoadon/{orderId}', 'CheckoutController@edit_hoadon') ;//sửa trạng thái qlđonhang
Route::post('/update-hoadon/{id_hoadon}', 'CheckoutController@update_hoadon') ;//ham update
Route::get('/delete-hoadon/{id_hoadon}', 'CheckoutController@delete_hoadon');

//-------------ADMIN
Route::get('/admin', 'AdminController@index');
Route::get('/giaodien', 'AdminController@admin_giaodien');
//dangnhap
Route::post('/admin-giaodien', 'AdminController@giaodien');
Route::get('/admin-dangxuat', 'AdminController@dangxuat');



//thuonghieu
Route::get('/add-thuonghieu', 'thuonghieuController@add_thuonghieu') ;
Route::get('/all-thuonghieu', 'thuonghieuController@all_thuonghieu') ;
//add themthuonghieu(ham)
Route::post('/save-thuonghieu', 'thuonghieuController@save_thuonghieu') ;
//edit suathuonghieu
Route::get('/edit-thuonghieu/{id_thuonghieu}', 'thuonghieuController@edit_thuonghieu') ;
//edit updatethuonghieu(ham)
Route::post('/update-thuonghieu/{id_thuonghieu}', 'thuonghieuController@update_thuonghieu') ;
//delete(xoa)
Route::get('/delete-thuonghieu/{id_thuonghieu}', 'thuonghieuController@delete_thuonghieu') ;

//dang
Route::get('/add-dang', 'dangController@add_dang') ;
Route::get('/all-dang', 'dangController@all_dang') ;
//add themdang(ham)
Route::post('/save-dang', 'dangController@save_dang') ;
//edit suadang
Route::get('/edit-dang/{id_dang}', 'dangController@edit_dang') ;
//edit updatedang(ham)
Route::post('/update-dang/{id_dang}', 'dangController@update_dang') ;
//delete(xoa)
Route::get('/delete-dang/{id_dang}', 'dangController@delete_dang') ;

//loai
Route::get('/add-loai', 'loaiController@add_loai') ;
Route::get('/all-loai', 'loaiController@all_loai') ;
//add themloai(ham)
Route::post('/save-loai', 'loaiController@save_loai') ;
//edit sualoai
Route::get('/edit-loai/{id_loai}', 'loaiController@edit_loai') ;
//edit updateloai(ham)
Route::post('/update-loai/{id_loai}', 'loaiController@update_loai') ;
//delete(xoa)
Route::get('/delete-loai/{id_loai}', 'loaiController@delete_loai') ;

//dungtich
Route::get('/add-dungtich', 'dungtichController@add_dungtich') ;
Route::get('/all-dungtich', 'dungtichController@all_dungtich') ;
//add themdungtich(ham)
Route::post('/save-dungtich', 'dungtichController@save_dungtich') ;
//edit suadungtich
Route::get('/edit-dungtich/{id_dungtich}', 'dungtichController@edit_dungtich') ;
//edit updatedungtich(ham)
Route::post('/update-dungtich/{id_dungtich}', 'dungtichController@update_dungtich') ;
//delete(xoa)
Route::get('/delete-dungtich/{id_dungtich}', 'dungtichController@delete_dungtich') ;

//sanpham
Route::get('/add-sanpham', 'sanphamController@add_sanpham') ;
Route::get('/all-sanpham', 'sanphamController@all_sanpham') ;
//add themsanpham(ham)
Route::post('/save-sanpham', 'sanphamController@save_sanpham') ;
//edit suasanpham
Route::get('/edit-sanpham/{id_sanpham}', 'sanphamController@edit_sanpham') ;
//edit updatesanpham(ham)
Route::post('/update_sanpham/{id_sanpham}', 'sanphamController@update_sanpham') ;
//delete(xoa)
Route::get('/delete-sanpham/{id_sanpham}', 'sanphamController@delete_sanpham') ;
//hienthi(nut like)
Route::get('/unactive-sanpham/{id_sanpham}', 'sanphamController@unactive_sanpham') ;
Route::get('/active-sanpham/{id_sanpham}', 'sanphamController@active_sanpham') ;

//khuyenmai
Route::get('/add-khuyenmai', 'KhuyenmaiController@add_khuyenmai') ;
Route::get('/add-spkhuyenmai', 'KhuyenmaiController@add_spkhuyenmai') ;
Route::get('/all-khuyenmai', 'KhuyenmaiController@all_khuyenmai') ;
//add themkhuyenmai(ham)
Route::post('/save-khuyenmai', 'KhuyenmaiController@save_khuyenmai') ;
//edit suakhuyenmai
Route::get('/edit-khuyenmai/{id_khuyenmai}', 'KhuyenmaiController@edit_khuyenmai') ;
//edit updatekhuyenmai(ham)
Route::post('/update-khuyenmai/{id_khuyenmai}', 'KhuyenmaiController@update_khuyenmai') ;
//delete(xoa)
Route::get('/delete-khuyenmai/{id_khuyenmai}', 'KhuyenmaiController@delete_khuyenmai') ;
Route::post('/save-sanphamkm', 'KhuyenmaiController@save_sanphamkm') ;

//banner
//add thembanner(ham)
Route::post('/save-banner', 'bannerController@save_banner') ;
Route::get('/add-banner', 'bannerController@add_banner') ;
Route::get('/all-banner', 'bannerController@all_banner') ;
//edit suasanpham
Route::get('/edit-banner/{id_banner}', 'bannerController@edit_banner') ;
//edit updatebanner(ham)
Route::post('/update-banner/{id_banner}', 'bannerController@update_banner') ;
//delete(xoa)
Route::get('/delete-banner/{id_banner}', 'bannerController@delete_banner') ;
//hienthi(nut like)
Route::get('/unactive-banner/{id_banner}', 'bannerController@unactive_banner') ;
Route::get('/active-banner/{id_banner}', 'bannerController@active_sanpham') ;