<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'taikhoan';

    public function getAllUsers($filter = [], $keywords = ''){
        if (empty($filter)){
            $users = DB::select("SELECT * FROM ".$this->table." WHERE HoVaTen LIKE '%".$keywords."%' OR DiaChi LIKE '%".$keywords."%'");
        } else {
            $users = DB::select("SELECT * FROM ".$this->table." WHERE IsAdmin='".$filter[0]."' AND (HoVaTen LIKE '%".$keywords."%' OR DiaChi LIKE '%".$keywords."%')");
            
        }

        return $users;
    }

    public function addUser($data){
        DB::insert('INSERT INTO '.$this->table.' (HoVaTen, NgaySinh, TenTaiKhoan, Email, password, SoDT, IsAdmin, DiaChi)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $data);
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' WHERE MaTK = ?', [$id]);
    }

    public function updateUser($data, $id){
        $data[] = $id;

        return DB::update('UPDATE '.$this->table.' SET
        HoVaTen=?,
        NgaySinh=?,
        TenTaiKhoan=?,
        Email=?,
        password=?,
        SoDT=?,
        IsAdmin=?,
        DiaChi=?
        WHERE MaTK = ?', $data);
    }

    public function deleteUser($id){
        $orders = DB::select('SELECT * FROM donhang WHERE MaTK=?', [$id]);

        if (empty($orders)){
            return DB::delete('DELETE FROM '.$this->table.' WHERE MaTK=?', [$id]);
        } else {
            return False;
        }

    }
}
