<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users;

class UsersController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }

    public function index(Request $request){
        $title = 'Danh sách tài khoản';

        $filter=[];

        if (!empty($request->isAdmin)){
            $isAdmin = $request->isAdmin;
            if ($isAdmin=='admin'){
                $isAdmin = '1';
            } else {
                $isAdmin = '0';
            }

            $filter[] = $isAdmin;
        }

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        } else {
            $keywords = '';
        }

        $usersList = $this->users->getAllUsers($filter, $keywords);

        return view('admin.users.list', compact('title', 'usersList'));
    }

    public function add(){
        $title = 'Thêm tài khoản';

        return view('admin.users.add', compact('title'));
    }

    public function handleAdd(Request $request){
        $request->validate([
            'fullname' => 'required|min:5',
            'dob' => 'required|date',
            'username' => 'required|regex:/^[\w_-]+$/|max:20|unique:taikhoan,TenTaiKhoan',
            'email' => 'required|email|unique:taikhoan,Email',
            'password' => 'required|min:6|regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!$#%*]).*$/',
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
            'email.unique' => 'Email đã tồn tại',
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
            (int)$request->admin,
            $request->address
        ];
        $this->users->addUser($dataInsert);

        return redirect(route('users.index'))->with('msg', 'Thêm người dùng thành công');
    }

    public function getEdit(Request $request, $id=0){
        $title = 'Cập nhật tài khoản';

        if (!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])){

                $request->session()->put('id', $id);    //Lưu id vào 1 session để khi thực hiện cập nhật có thể lấy ra id
                $userDetail = $userDetail[0];

            } else {
                return redirect()->route('users.index')->with('msg', 'Người dùng không tồn tại');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('admin.users.edit', compact('title', 'userDetail'));
    }

    public function handleEdit(Request $request){

        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'fullname' => 'required|min:5',
            'dob' => 'required|date',
            'username' => 'required|regex:/^[\w_-]+$/|max:20|unique:taikhoan,TenTaiKhoan,'.$id.',MaTK',
            'email' => 'required|email|unique:taikhoan,Email,'.$id.',MaTK',
            'password' => 'required|min:6|regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!$#%*]).*$/',
            'phoneNum' => 'required|regex:/^[0-9]{10}$/',
        ], [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ :min ký tự trở lên',
            'dob.required' => "Ngày sinh bắt buộc phải nhập",
            'dob.date' => "Ngày sinh không hợp lệ",
            'email.required' => "Email bắt buộc phải nhập",
            'email.email' => "Email không đúng định dạng",
            'email.unique' => 'Email đã tồn tại',
            'password.required' => "Password bắt buộc phải nhập",
            'password.min' => "Password phải có ít nhất 6 ký tự",
            'password.regex' => "Password phải chứa ít nhất 1 ký tự viết hoa, viết thường, ký tự đặc biệt, và số",
            'phoneNum.required' => "Số điện thoại bắt buộc phải nhập",
            'phoneNum.regex' => "Số điện thoại bao gồm 10 số",
        ]);

        $dataUpdate = [
            $request->fullname,
            $request->dob,
            $request->username,
            $request->email,
            //$request->password,
            bcrypt($request->password),
            $request->phoneNum,
            (int)$request->admin,
            $request->address
        ];

        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete($id=0){
        if (!empty($id)){

            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])){

                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus){
                    $msg = 'Xóa người dùng thành công';
                } else {
                    $msg = 'Bạn không thể xóa người dùng lúc này. Vui lòng thử lại sau';
                }

            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }
}
