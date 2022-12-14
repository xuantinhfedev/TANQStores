<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\taikhoan;
use App\Models\LayTheLoai;
use App\Models\LayDanhMuc;
use App\Models\LayTaiKhoan;

class ThongTinCaNhanController extends Controller
{
    public function index(){

        return view('ThongTinCaNhan');
    }
    public function goToThongTinCaNhan(Request $request){
        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        $TenTaiKhoan = $request->session()->get('TenTaiKhoan');
        $tk = new LayTaiKhoan();
        $taikhoan = $tk->layThongTinKH($TenTaiKhoan);
        // dd($taikhoan);
        return view('ThongTinCaNhan', compact('taikhoan', 'danhmuc', 'theloai'));
    }
    public function formSua(Request $request){
        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        $MaTK = $request->session()->get('TenTaiKhoan');
        $tk = new LayTaiKhoan();
        $taikhoan = $tk->layThongTinKH($MaTK);
        return view('SuaThongTinCaNhan',compact('taikhoan', 'danhmuc', 'theloai'));
    }
    public function postSua(Request $request){
        $rule = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'dateOfBirth' => 'required',
            'phoneNum' => 'numeric'
        ];
        $message = [
            'required' => ':attribute bat buoc phai nhap !',
            'min' => ':attribute phai co it nhat :min ki tu !',
            'email' => ':attribute khong dung dinh dang!',
            'numeric' => ':attribute khong dung dinh dang !'
        ];
        $request->validate($rule,$message);
        $TenTaiKhoan = $request->session()->get('TenTaiKhoan');   
        $tk = new LayTaiKhoan();
        $data = [
            $request->name,
            $request->dateOfBirth,
            $request->email,
            $request->DiaChi,
            $request->phoneNum,
            $TenTaiKhoan
        ];
        $taikhoan = $tk->SuaThongTin($data);

        return redirect()->route('ThongTinCaNhan.index')->with('Sửa thành công !!!');
    }
}
