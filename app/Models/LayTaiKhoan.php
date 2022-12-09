<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LayTaiKhoan extends Model
{

    public function layThongTinKH($TenTaiKhoan){
        // dd($MaTK);
        $tk = DB::select('SELECT * FROM taikhoan WHERE TenTaiKhoan = "'.$TenTaiKhoan.'"');

        return $tk;
    }
    public function SuaThongTin($data){
        $suaThongTin = DB::update('UPDATE taikhoan SET HoVaTen = ?,NgaySinh = ?,Email = ?,DiaChi = ?,SoDT = ? WHERE TenTaiKhoan = ?',$data);
        return $suaThongTin;
    }
    public function GETIDTK($data){
        $MaTK = DB::select('SELECT MaTK FROM taikhoan WHERE TenTaiKhoan = "'.$data.'"');
        return $MaTK;
    }
}
