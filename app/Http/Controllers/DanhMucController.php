<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DanhMuc;

class DanhMucController extends Controller
{
    private $danhmuc;
    public function __construct()
    {
        $this->danhmuc = new DanhMuc();
    }

    public function index(){
        $title = 'Danh sách danh mục';

        $danhmucList = $this->danhmuc->getAllDanhMuc();

        return view('admin.danhmuc.list', compact('title', 'danhmucList'));
    }
    
    public function add(){
        $title = 'Thêm danh mục';
        
        return view('admin.danhmuc.add', compact('title'));
    }

    public function handleAdd(Request $request){
        $request->validate([
            'name' => 'required|min:2|unique:danhmuc,TenDanhMuc',
        ], [
            'name.required' => 'Tên danh mục bắt buộc phải nhập',
            'name.min' => 'Tên danh mục tối thiểu phải có 2 ký tự',
            'name.unique' => 'Tên danh mục đã tồn tại',
        ]);

        $dataInsert = [
            $request->name
        ];
        $this->danhmuc->addDanhMuc($dataInsert);

        return redirect(route('danhmuc.index'))->with('msg', 'Thêm danh mục thành công');
    }

    public function getEdit(Request $request, $id=0){
        $title = 'Cập nhật danh mục';

        if (!empty($id)){
            $danhmucDetail = $this->danhmuc->getDetail($id);
            if (!empty($danhmucDetail[0])){

                $request->session()->put('id', $id);    //Lưu id vào 1 session để khi thực hiện cập nhật có thể lấy ra id
                $danhmucDetail = $danhmucDetail[0];
                
            } else {
                return redirect()->route('danhmuc.index')->with('msg', 'Thể loại không tồn tại');
            }
        } else {
            return redirect()->route('danhmuc.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('admin.danhmuc.edit', compact('title', 'danhmucDetail'));
    }

    public function handleEdit(Request $request){
        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'name' => 'required|min:2|unique:danhmuc,TenDanhMuc,'.$id.',MaDanhMuc',
        ], [
            'name.required' => 'Tên danh mục bắt buộc phải nhập',
            'name.min' => 'Tên danh mục tối thiểu phải có 2 ký tự',
        ]);

        $dataUpdate = [
            $request->name
        ];
        $this->danhmuc->updateDanhMuc($dataUpdate, $id);

        return back()->with('msg', 'Cập nhật danh mục thành công');
    }

    public function delete($id=0){
        if (!empty($id)){

            $danhmucDetail = $this->danhmuc->getDetail($id);
            if (!empty($danhmucDetail[0])){

                $deleteStatus = $this->danhmuc->deleteDanhMuc($id);
                if ($deleteStatus){
                    $msg = 'Xóa danh mục thành công';
                } else {
                    $msg = 'Bạn không thể xóa danh mục lúc này. Vui lòng thử lại sau';
                }

            } else {
                $msg = 'Danh mục không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('danhmuc.index')->with('msg', $msg);
    }
}
