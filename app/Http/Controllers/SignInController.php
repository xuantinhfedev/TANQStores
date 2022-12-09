<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SignIn;
use Illuminate\Support\Facades\Storage;
use App\Models\LaySanPham;
use App\Models\LayTheLoai;
use App\Models\LayDanhMuc;

class SignInController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new SignIn();
    }


    public function checkinfo(Request $request){
        $request->validate([
            'fullname' => 'required|min:5',
            'dob' => 'required|date',
            'username' => 'required|regex:/^[\w_-]+$/|max:20|unique:taikhoan,TenTaiKhoan',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phoneNum' => 'required|regex:/^[0-9]{10}$/',
        ], [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ :min ký tự trở lên',
            'dob.required' => "Ngày sinh bắt buộc phải nhập",
            'dob.date' => "Ngày sinh không hợp lệ",
            'username.required' => "Tên tài khoản bắt buộc phải nhập",
            'username.regex' => "Tên tài khoản chỉ được chứa ký tự, số và dấu '-' hoặc '_'",
            'username.unique' => "Tên tài khoản đã tồn tại",
            'email.required' => "Email bắt buộc phải nhập",
            'email.email' => "Email không đúng định dạng",
            'password.required' => "Password bắt buộc phải nhập",
            'password.min' => "Password phải có ít nhất 6 ký tự",
            'password.regex' => "Password phải chứa ít nhất 1 ký tự viết hoa, viết thường, ký tự đặc biệt, và số",
            'phoneNum.required' => "Số điện thoại bắt buộc phải nhập",
            'phoneNum.regex' => "Số điện thoại bao gồm 10 số",
        ]);

        $dataInsert = [
            $request->fullname,
            $request->dob,
            $request->username,
            $request->email,
            bcrypt($request->password),
            $request->phoneNum,

        ];
        $this->users->addUser($dataInsert);
        $request->session()->put('TenTaiKhoan', $request->username);
        Storage::disk('local')->put($request->username.'.txt', '');
        // $request->session()->forget('TenTaiKhoan');
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        //return view('home', compact('sanphamnam','sanphamnu','theloai','danhmuc'));
        return view("home", compact('SanPhamList','sanphamnu','theloai','danhmuc'));
        // redirect()->back()->with('success', 'Đăng Ký thành công')
    }
    public function checkout(){
        session()->forget('TenTaiKhoan');
        session()->forget('GH');
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        //return view('home', compact('sanphamnam','sanphamnu','theloai','danhmuc'));
        return view("home", compact('SanPhamList','sanphamnu','theloai','danhmuc'));
    }
    public function checkoutadmin(){
        session()->forget('admin');
        return view('LoginAdmin');
    }
    
}
