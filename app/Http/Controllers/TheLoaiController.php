<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    private $theloai;
    public function __construct()
    {
        $this->theloai = new TheLoai();
    }

    public function index(){
        $title = 'Danh sách thể loại';

        $theloaiList = $this->theloai->getAllTheLoai();

        return view('admin.theloai.list', compact('title', 'theloaiList'));
    }
    
    public function add(){
        $title = 'Thêm thể loại';
        
        return view('admin.theloai.add', compact('title'));
    }

    public function handleAdd(Request $request){
        $request->validate([
            'name' => 'required|min:2|unique:theloai,TenTheLoai',
        ], [
            'name.required' => 'Tên thể loại bắt buộc phải nhập',
            'name.min' => 'Tên thể loại tối thiểu phải có 2 ký tự',
            'name.unique' => 'Tên thể loại đã tồn tại',
        ]);

        $dataInsert = [
            $request->name
        ];
        $this->theloai->addTheLoai($dataInsert);

        return redirect(route('theloai.index'))->with('msg', 'Thêm thể loại thành công');
    }

    public function getEdit(Request $request, $id=0){
        $title = 'Cập nhật thể loại';

        if (!empty($id)){
            $theloaiDetail = $this->theloai->getDetail($id);
            if (!empty($theloaiDetail[0])){

                $request->session()->put('id', $id);    //Lưu id vào 1 session để khi thực hiện cập nhật có thể lấy ra id
                $theloaiDetail = $theloaiDetail[0];
                
            } else {
                return redirect()->route('theloai.index')->with('msg', 'Thể loại không tồn tại');
            }
        } else {
            return redirect()->route('danhmuc.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('admin.theloai.edit', compact('title', 'theloaiDetail'));
    }

    public function handleEdit(Request $request){
        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'name' => 'required|min:2|unique:theloai,TenTheLoai,'.$id.',MaTheLoai',
        ], [
            'name.required' => 'Tên thể loại bắt buộc phải nhập',
            'name.min' => 'Tên thể loại tối thiểu phải có 2 ký tự',
            'name.unique' => 'Tên thể loại đã tồn tại',
        ]);

        $dataUpdate = [
            $request->name
        ];
        $this->theloai->updateTheLoai($dataUpdate, $id);

        return back()->with('msg', 'Cập nhật thể loại thành công');
    }

    public function delete($id=0){
        if (!empty($id)){

            $theloaiDetail = $this->theloai->getDetail($id);
            if (!empty($theloaiDetail[0])){

                $deleteStatus = $this->theloai->deleteTheLoai($id);
                if ($deleteStatus){
                    $msg = 'Xóa thể loại thành công';
                } else {
                    $msg = 'Bạn không thể xóa thể loại lúc này. Vui lòng thử lại sau';
                }

            } else {
                $msg = 'Thể loại không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('theloai.index')->with('msg', $msg);
    }
}
