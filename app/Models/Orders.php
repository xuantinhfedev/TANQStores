<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'donhang';

    public function getAllOrders($dates = [], $status = '', $keywords = ''){
        // $orders = DB::select('SELECT tb1.*, tb2.HoVaTen, tb2.Email FROM '.$this->table.' tb1 JOIN taikhoan tb2
        // on tb1.MaTK = tb2.MaTK');

        if (empty($status)){
            $orders = DB::select("SELECT tb1.*, tb2.Email FROM ".$this->table." tb1 LEFT OUTER JOIN taikhoan tb2
            on tb1.MaTK = tb2.MaTK WHERE (tb1.HoVaTen LIKE '%".$keywords."%' OR
            DiaChiNhanHang LIKE '%".$keywords."%') AND (NgayDatHang BETWEEN ".$dates[0]." AND ".$dates[1].") ORDER BY MaDonHang");
        } else {
            $orders = DB::select("SELECT tb1.*, tb2.Email FROM ".$this->table." tb1 LEFT OUTER JOIN taikhoan tb2
            on tb1.MaTK = tb2.MaTK WHERE TrangThai='".$status."' AND (tb1.HoVaTen LIKE '%".$keywords."%' OR
            DiaChiNhanHang LIKE '%".$keywords."%') AND (NgayDatHang BETWEEN ".$dates[0]." AND ".$dates[1].") ORDER BY MaDonHang");
        }
        return $orders;
    }

    public function getDetail($id){
        return DB::select('SELECT tb1.*, tb2.Email FROM '.$this->table.' tb1 LEFT OUTER JOIN taikhoan tb2
        on tb1.MaTK = tb2.MaTK WHERE MaDonHang=?', [$id]);
    }
    public function getDetailAcc($id){
        return DB::select('SELECT tb1.* FROM donhang tb1 JOIN taikhoan tb2
        on tb1.MaTK = tb2.MaTK WHERE TenTaiKhoan=?', [$id]);
    }
    public function getDetailAccHTV($id){
        return DB::select('SELECT * FROM  taikhoan 
         WHERE TenTaiKhoan=?', [$id]);
    }

    public function getProductsInOrder($id){
        return DB::select('SELECT tb1.*, tb2.Size, tb3.TenSP FROM chitietdonhang tb1 JOIN chitietsanpham tb2
        on tb1.ChiTietSPID = tb2.ChiTietSPID JOIN sanpham tb3 on tb2.MaSP = tb3.MaSP
        WHERE tb1.MaDonHang=?', [$id]);
    }

    public function deleteOrder($id){
        return DB::delete('DELETE FROM '.$this->table.' WHERE MaDonHang=?', [$id]);
    }

    public function updateStatus($data, $id){
        $data[] = $id;
        return DB::update('UPDATE '. $this->table .' SET TrangThai=? WHERE MaDonHang=?', $data);
    }
    public function insertDH($data){
        $query = DB::insert('INSERT INTO '. $this->table .'(MaDonHang,HoVaTen,NgayDatHang,HinhThucVanChuyen,NgayNhanHang,DiaChiNhanHang,SoDT,GhiChu,MaTK,TongTien,TrangThai) VALUES (?,?,?,?,?,?,?,?,?,?,?)',$data);
        return $query;
    }
    public function layDSDH(){
        $query = DB::select('SELECT * FROM donhang');
        return $query;
    }
    public function insertCTDH($data){
        $query = DB::insert('INSERT INTO chitietdonhang(MaDonHang,ChiTietSPID,SoLuong,GiaTien) VALUES(?,?,?,?)',$data);
        return $query;
    }
    public function selectCTDH($id){
        // dd($id);
        $query = DB::select('SELECT * FROM chitietdonhang WHERE MaDonHang = "'.$id.'"');
        return $query;
    }
}
