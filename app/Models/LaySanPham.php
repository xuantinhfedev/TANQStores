<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class LaySanPham extends Model
{
    public function getSP_TheLoai($id, $iddm){

        // Câu truy vấn lấy san pham theo id
        $sp= DB::select('SELECT * FROM sanpham WHERE MaTheLoai = "'.$id.'" AND MaDanhMuc = "'.$iddm.'"');

        return $sp;
    }
    function getAllSanPham_Nu(){

        $sp = DB::select('SELECT sanpham.*, SUM(SoLuongCon) as TongSoLuongCon FROM `chitietsanpham` INNER JOIN sanpham ON sanpham.MaSP = chitietsanpham.MaSP  WHERE sanpham.MaDanhMuc = 2 GROUP BY sanpham.MaSP,sanpham.TenSP,sanpham.GiaBan,sanpham.MoTa,sanpham.hinhanh, sanpham.madanhmuc, sanpham.matheloai, sanpham.khuyenmai');

        return $sp;
    }
    function getAllSanPham_Nam(){

        $sp = DB::select('SELECT sanpham.*, SUM(SoLuongCon) as TongSoLuongCon FROM `chitietsanpham` INNER JOIN sanpham ON sanpham.MaSP = chitietsanpham.MaSP WHERE sanpham.MaDanhMuc =1 GROUP BY sanpham.MaSP,sanpham.TenSP,sanpham.GiaBan,sanpham.MoTa,sanpham.hinhanh, sanpham.madanhmuc, sanpham.matheloai, sanpham.khuyenmai');

        return $sp;
    }
    function getSP_DanhMuc($iddm){

        // Câu truy vấn lấy san pham theo danh muc
        $sp = DB::select('SELECT * FROM sanpham WHERE MaDanhMuc = '.$iddm);

        return $sp;
    }
    function getSP_HOT(){

        // Câu truy vấn lấy san pham theo danh muc
        $sp = DB::select('SELECT sanpham.*,SUM(SoLuong) as TSL FROM chitietdonhang INNER JOIN chitietsanpham on chitietsanpham.ChiTietSPID = chitietdonhang.ChiTietSPID INNER JOIN donhang on chitietdonhang.MaDonHang = donhang.MaDonHang INNER JOIN sanpham on sanpham.MaSP = chitietsanpham.MaSP WHERE donhang.TrangThai="Đã giao" GROUP BY sanpham.MaSP,sanpham.TenSP,sanpham.GiaBan,sanpham.MoTa,sanpham.hinhanh, sanpham.madanhmuc, sanpham.matheloai, sanpham.khuyenmai Order by TSL desc ');

        return $sp;
    }
    function getSanPham($id){

        // Câu truy vấn lấy san pham theo id
        $sp = DB::select('SELECT * FROM sanpham WHERE MaSP = '.$id);

        return $sp;
    }
    function getSP_Name($name){

        // Câu truy vấn lấy san pham theo ten
        $sp = DB::select('SELECT * FROM sanpham WHERE TenSP ='.$name);

        return $sp;
    }
}
