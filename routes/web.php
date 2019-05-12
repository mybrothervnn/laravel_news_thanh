<?php

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
use App\TestModel;
use App\TheLoai;

Route::get('/', function () {
    return view('welcome');
});
// tạo 1 Route tên là QueryBuilder
// để in ra tên của User có id = 1 trong bảng Test
Route::get('QueryBuilder',function(){
	echo DB::table('Test')->where('id',1)->value('Name');
	
	// var_dump($kq);
});
Route::get('testModel',function(){
	$tl = TheLoai::find(2);
	echo $tl->Ten;
});

Route::get('test_get_loai_tin_from_the_loai/{n}',function($n){
	// in ra tên của tất cả các loại tin thuộc thể loại Xa Hoi. (1);
	//1: lấy thể loại có id =1:
	$tl = TheLoai::find($n);
	echo 'Tên thể loại:' . $tl->Ten."<br/><br/>";
	
	//2: lấy danh sách tin tức của thể loại trên
	$loaitinList = $tl->loaitin;
	// var_dump($loaitinList);

	//3: Lấy từng loại tin trong danh sách trên
	foreach ($loaitinList as $loaitin) {
		//in ra 
		echo $loaitin->Ten."<br/>";
	}

});

//test hiển thị trang admin
Route::get('test_admin',function(){
	return view('admin.theloai.danhsach');
});
//group Route để truy cập trang admin
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');	

		Route::get('sua/{id}','TheLoaiController@getSua');	
		Route::post('sua/{id}','TheLoaiController@postSua');

		Route::get('them','TheLoaiController@getThem');	
		Route::post('postthem','TheLoaiController@postThem');	

		Route::get('xoa/{id}','TheLoaiController@getXoa');
	});	
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','LoaiTinController@getDanhSach');	

		Route::get('sua/{id}','LoaiTinController@getSua');	
		Route::post('sua/{id}','LoaiTinController@postSua');

		Route::get('them','LoaiTinController@getThem');	
		Route::post('postthem','LoaiTinController@postThem');	

		Route::get('xoa/{id}','LoaiTinController@getXoa');
	});
	Route::group(['prefix'=>'user'],function(){
 		Route::get('danhsach','UserController@getDanhSach');

 		Route::get('sua/{id}','UserController@getSua');
 		Route::post('sua/{id}','UserController@postSua');

 		Route::get('them','UserController@getThem');
 		Route::post('postthem','UserController@postThem');

 		Route::get('xoa/{id}','UserController@getXoa');
	});
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','SlideController@getDanhsach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');
	});	
});



//Phần hiển thị trang chủ
//https://www.youtube.com/watch?v=FO4RS_F0oIw&list=PLzrVYRai0riQ-K705397wDnlhhWu-gAUh&index=66
Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{idLoaiTin}/{tenkhongdau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{tenkhongdau}.html','PagesController@tintuc');
