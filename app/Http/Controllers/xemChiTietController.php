<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\theloai;
use App\Models\danhmuc;

class xemChiTietController extends Controller
{
    //
    public function index(){
        return view('xemChiTiet');
    }
    public function goToXemChiTiet($id){
        $sp = new sanpham();
        $sanpham = $sp->getSanPham($id);

        $tl = new theloai();
        $theloai = $tl->getAllTheLoai();

        $dm = new danhmuc();
        $danhmuc = $dm->getAllDanhMuc();
        return view('xemChiTiet', compact('sanpham','theloai','danhmuc'));
    }
}
