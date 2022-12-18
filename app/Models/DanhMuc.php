<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'danhmuc';

    public function getAllDanhMuc(){
        $allDanhMuc = DB::select('SELECT * FROM '.$this->table);

        return $allDanhMuc;
    }

    function getDMName($iddm){
        $dm = DB::select('SELECT * FROM danhmuc WHERE MaDanhMuc = "'.$iddm.'"');

        return $dm;
    }

    public function addDanhMuc($data){
        DB::insert('INSERT INTO '.$this->table.' (TenDanhMuc) VALUES (?)', $data);
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' WHERE MaDanhMuc = ?', [$id]);
    }

    public function updateDanhMuc($data, $id){
        $data[] = $id;

        return DB::update('UPDATE '.$this->table.' SET TenDanhMuc=? WHERE MaDanhMuc = ?', $data);

    }

    public function deleteDanhMuc($id){
        $deleteOK = 1;
        //Lấy ra danh sách mã sản phẩm tương ứng với mã danh mục
        $productID = DB::select('SELECT MaSP FROM sanpham WHERE MaDanhMuc=?', [$id]);
        //Kiểm tra xem có sản phẩm nào tồn tại trong đơn hàng nào không
        foreach ($productID as $item){
            //Lấy ra các mã chi tiết sản phẩm
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

        //Nếu trong các đơn hàng không có đơn hàng nào có sản phẩm nằm trong danh mục thì được phép xóa
        if ($deleteOK == 1){
            return DB::delete('DELETE FROM '.$this->table.' WHERE MaDanhMuc=?', [$id]);
        } else {
            return False;
        }

    }
}
