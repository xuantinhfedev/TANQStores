<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class SignIn extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'taikhoan';
    // protected $guarded = 'taikhoans';

    protected $fillable=[
        'TenTaiKhoan','MatKhau',
    ];
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public function addUser($data){
        DB::insert('INSERT INTO '.$this->table.' (HoVaTen, NgaySinh, TenTaiKhoan, Email, password, SoDT,IsAdmin, DiaChi,TTGioHang, TinhTrang)
        VALUES (?, ?, ?, ?, ?, ?,0, 1, 0, 0)', $data);
    }
}
