<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
    	// Lấy tất cả danh sách Thể loại -> view admin.theloai.danhsach
    	$data = TheLoai::all(); // Lấy toàn bộ thể loại từ Model
    	return view('admin.theloai.danhsach',['dsTheLoai'=>$data]);
    }
    public function getThem(){
    	return view('admin.theloai.them');
    }
    public function postThem(Request $req){
        // xử lý xác nhận/ kiểm tra tính hợp lệ; validation
        $this->validate($req
            ,['Ten'=>'required|min:3|max:30|unique:TheLoai,Ten']
            ,[  'required'=>'Trường này không được để trống'
                ,'min'=>'Độ dài phải > 3'
                ,'max'=>'Độ dài phải < 30'
                ,'unique'=>'Thể loại này đã tồn tại'
            ]
        );
        //Tạo model thể loại
    	$theloai = new TheLoai();
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten);
        // $theloai->created_at = new DateTime();
        //lưu vào CSDL
        $theloai->save();

        //chuyển hướng tới view them
        return redirect('admin/theloai/them')->with('thongbao','Đã thêm thành công');
    }   
    public function getSua($id) {
        // yêu cầu Model lấy thể loại ra 
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);

    }
    public function postSua(Request $req,$id) {
        // yêu cầu Model lấy thể loại ra 
        $theloai = TheLoai::find($id);
        //validate dữ liệu trong Request
        $this->validate($req
            ,['Ten'=>'required|min:3|max:30|unique:TheLoai']
            ,[  'required'=>'Trường này không được để trống'
                ,'min'=>'Độ dài phải > 3'
                ,'max'=>'Độ dài phải < 30'
                ,'unique'=>'Thể loại này đã tồn tại'
            ]
        );
        $theloai->Ten = $req->Ten;
        $theloai->TenKhongDau = changeTitle($req->Ten,'-',MB_CASE_TITLE);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Đã sửa thể loại thành công');
        
    }
    function getXoa($id){
        $theloai = TheLoai::find($id);
        $ten = $theloai->Ten;
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao',"Bạn đã xóa thành công Thể loại : $ten");
    }
}
