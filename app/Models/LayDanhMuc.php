<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class LayDanhMuc extends Model
{
    public function getAllDanhMuc(){

        // Câu truy vấn lấy tất cả sinh viên
        $danhmuc = DB::select('SELECT * FROM danhmuc');

        return $danhmuc;
    }

    function getDanhMuc($iddm){
        // Câu truy vấn lấy danh muc theo ma danh muc
        $dm = DB::select('SELECT * FROM danhmuc WHERE MaDanhMuc = '.$iddm);

        return $dm;
    }

    
}
