<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\danhmuc;
use App\Models\SanPham;
use App\Models\LaySanPham;
use App\Models\LayTaiKhoan;
use App\Models\LayTheLoai;
use App\Models\theloai;
use App\Models\LayDanhMuc;


class XemDanhMucController extends Controller
{
    public function index(){
        return view('XemDanhMuc');
    }
    public function goToXemDanhMuc($id){
        $sp = new LaySanPham();
        $SanPhamList = $sp->getSP_DanhMuc($id);

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        $dm2 = new LayDanhMuc();
        $dmid = $dm2->getDanhMuc($id);

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $spnam = new LaySanPham();
        $sanpham = $spnam->getAllSanPham_Nam();

        return view('XemDanhMuc', compact('SanPhamList','sanpham','danhmuc','dmid','theloai','id'));
    }
    public function LocDanhMuc(Request $request){
        
        // dd($request->all());
        $x1 = $request->Value1;
        $x2 = $request->Value2;
        if($x1>$x2){
            $x1 = $request->Value2;
            $x2 = $request->Value1;
        }
        // dd($request->MaDM);
        $spnew = new SanPham();
        // dd($sp->LocSP($x1, $x2,$request->SizeLoc));
        $sp = $spnew->LocSP($x1, $x2,$request->SizeLoc,$request->MaDM);
        $id = $request->MaDM;
        // dd($sp);
        return view('XemDanhMuc', compact('sp','id'));
    }
}
