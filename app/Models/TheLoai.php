<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class TheLoai extends Model
{
    use HasFactory;

    protected $table = 'theloai';

    public function getAllTheLoai(){
        $allTheLoai = DB::select('SELECT * FROM '.$this->table);

        return $allTheLoai;
    }

    public function addTheLoai($data){
        DB::insert('INSERT INTO '.$this->table.' (TenTheLoai) VALUES (?)', $data);
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' WHERE MaTheLoai = ?', [$id]);
    }

    public function updateTheLoai($data, $id){
        $data[] = $id;

        return DB::update('UPDATE '.$this->table.' SET TenTheLoai=? WHERE MaTheLoai = ?', $data);

    }

    public function deleteTheLoai($id){
        $deleteOK = 1;
        //Lấy ra danh sách mã sản phẩm tương ứng với mã thể loại
        $productID = DB::select('SELECT MaSP FROM sanpham WHERE MaTheLoai=?', [$id]);
        //Kiểm tra xem có sản phẩm nào tồn tại trong đơn hàng nào không
        foreach ($productID as $item){
            //Lấy ra mã chi tiết sản phẩm
            $detailID = DB::select('SELECT ChiTietSPID FROM chitietsanpham WHERE MaSP=?', [$item->MaSP]);
            if (empty($detailID)){
                continue;
            } else {
                foreach($detailID as $detail){
                    //Lấy ra mã đơn hàng
                    $orderDetail = DB::select('SELECT * FROM chitietdonhang WHERE ChiTietSPID=?', [$detail->ChiTietSPID]);
                    if (empty($orderDetail)){
                        continue;
                    } else {
                        $deleteOK = 0;
                        break;
                    }
                }
                if ($deleteOK == 0){
                    break;
                }
            }
        }

        //Nếu trong các đơn hàng không có đơn hàng nào có sản phẩm nằm trong thể loại thì được phép xóa
        if ($deleteOK == 1){
            return DB::delete('DELETE FROM '.$this->table.' WHERE MaTheLoai=?', [$id]);
        } else {
            return False;
        }

    }
}
