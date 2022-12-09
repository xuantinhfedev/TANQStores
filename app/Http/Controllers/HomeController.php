<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\LaySanPham;
use App\Models\LayTheLoai;
use App\Models\LayDanhMuc;
use Illuminate\Support\Facades\Storage;
use App\Models\SanPham;

class homeController extends Controller
{
    public function home(){
        // dd($data);
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        $sph = new LaySanPham();
        $sanphamhot = $sph->getSP_HOT();

        //return view('home', compact('sanphamnam','sanphamnu','theloai','danhmuc'));
        return view("home", compact('SanPhamList','sanphamnu','theloai','danhmuc','sanphamhot'));
    }

    public function notification(){
        // dd($data);
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        //return view('home', compact('sanphamnam','sanphamnu','theloai','danhmuc'));
        return view("ThongBao", compact('SanPhamList','sanphamnu','theloai','danhmuc'));
    }

    public function register(){
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();
        return view('DangNhap', compact('SanPhamList','sanphamnu','theloai','danhmuc'));
    }
    public function signin(){
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();
        return view('DangKy', compact('SanPhamList','sanphamnu','theloai','danhmuc'));
    }

    public function test(){
        $data = $data = DB::table('chitietsanpham')->where('Size', 30)->get('ChiTietSPID');
        // Storage::disk('local')->put('example.txt', json_encode(Session('cart')));
        $sp = DB::select('SELECT sanpham.*,SUM(SoLuong) as TSL FROM chitietdonhang INNER JOIN chitietsanpham on chitietsanpham.ChiTietSPID = chitietdonhang.ChiTietSPID INNER JOIN donhang on chitietdonhang.MaDonHang = donhang.MaDonHang INNER JOIN sanpham on sanpham.MaSP = chitietsanpham.MaSP WHERE donhang.TrangThai="Đã giao" GROUP BY sanpham.MaSP,sanpham.TenSP,sanpham.GiaBan,sanpham.MoTa,sanpham.hinhanh, sanpham.madanhmuc, sanpham.matheloai, sanpham.khuyenmai Order by TSL desc ');

        dd($sp);
        // .var_export
    }
    public function KTDonHang(){
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();
        return view('KTDonHang', compact('SanPhamList','sanphamnu','theloai','danhmuc'));
    }
}
