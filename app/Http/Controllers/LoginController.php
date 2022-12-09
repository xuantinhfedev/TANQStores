<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\LaySanPham;
use App\Models\LayTheLoai;
use App\Models\LayDanhMuc;
class LoginController extends Controller
{
    //
    public function __construct()
    {

    }
    public function LoginAuth(Request $request){

        $request->validate([
            'username'=>'required|regex:/^[\w_-]+$/|max:20',
            'password'=>'required|min:6'
        ],[
            'username.required'=>'Bắt buộc nhập tên tài khoản',
            // 'usernane.regex'=>'tài khoản phải không hợp lệ',
            'password.required'=>'Bắt buộc nhập Mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn',

        ]);
        $arr = [
            'TenTaiKhoan' =>$request->username,
            'password' =>($request->password),
            'IsAdmin' => 0
        ];
        // dd($arr);
        // dd($arr);
        if(Auth::guard('taikhoan')->attempt($arr)){
            // dd('thành công');
            $request->session()->put('TenTaiKhoan', $request->username);
            // dd($request->session()->all());
            // return view('home')->with('username', $request->username);
            // dd(session()->get('TenTaiKhoan'));
            $cart = json_decode((Storage::disk('local')->get(session()->get('TenTaiKhoan').'.txt')), true);
            if($cart!='')
                session()->put('GH', $cart);
            return redirect()->route('home')->with('username', $request->username);
        }else{
            return redirect()->back()->with('fail', 'Mật Khẩu hoặc tài khoản chưa chính xác');
        }
    }
    public function checkdata(){
        $data = DB::select('SELECT * FROM `taikhoan` WHERE 1');
        dd($data);
    }
    public function LoginAdmin(Request $request){

        $request->validate([
            'username'=>'required|max:20',
            'password'=>'required|min:6'
        ],[
            'username.required'=>'Bắt buộc nhập tên tài khoản',
            // 'usernane.regex'=>'tài khoản phải không hợp lệ',
            'password.required'=>'Bắt buộc nhập Mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn',

        ]);
        $arr = [
            'TenTaiKhoan' =>$request->username,
            'password' =>($request->password),
            'IsAdmin' => 1
        ];
        // dd($arr);
        // dd($arr);
        if(Auth::guard('taikhoan')->attempt($arr)){
            // dd('thành công');
            $request->session()->put('admin', $request->username);
            // dd($request->session()->all());
            // return view('home')->with('username', $request->username);
            // dd(session()->get('TenTaiKhoan'));

            return redirect()->route('adminsite')->with('username', $request->username);
        }else{
            return redirect()->back()->with('fail', 'Mật Khẩu hoặc tài khoản chưa chính xác');
        }
    }
    // public function authenticate(Request $request){
    //     $user['info'] = $request->username;
    //     $arr = [
    //         'TenTaiKhoan' => $user,
    //         'password' =>$request->password
    //     ];
    //     dd($user);
    //     // if(Auth::guard('taikhoan')->attempt([$arr])){
    //     //     dd('thành công');
    //     // }else{
    //     //     dd('thất bại');
    //     // }
    // }
}
