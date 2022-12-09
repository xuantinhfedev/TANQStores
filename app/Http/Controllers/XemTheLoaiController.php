<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\theloai;
use App\Models\danhmuc;
use App\Models\sanpham;
use App\Models\LaySanPham;
class XemTheLoaiController extends Controller
{
    //Action index
    public function index(){
        return view('XemTheLoai');
    }
    public function getSP_TheLoai(Request $request,$id){
        $iddm = $request->session()->get('MaDanhMuc',2);
        // Câu truy vấn lấy san pham theo id
        $sp= new LaySanPham();
        $sanpham = $sp->getSP_TheLoai($id,$iddm);

        $tl = new theloai();
        $theloai = $tl->getAllTheLoai();

        $dm = new danhmuc();
        $danhmuc = $dm->getAllDanhMuc();
        $tendm = $dm->getDMName($iddm);

        return view('XemTheLoai', compact('sanpham','theloai','danhmuc','tendm'));
    }
}
