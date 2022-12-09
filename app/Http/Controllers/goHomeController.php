<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaySanPham;
use App\Models\LayTheLoai;
use App\Models\LayDanhMuc;

class goHomeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function goHome(){
        
        $spnam = new LaySanPham();
        $sanphamnam = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();
        
        return view('home', compact('sanphamnam','sanphamnu','theloai','danhmuc'));
    }

}
