<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ThongKe extends Model
{
    use HasFactory;

    public function getOrdersByDate($from_date, $to_date){
        return DB::select("SELECT * FROM donhang WHERE NgayNhanHang BETWEEN ".$from_date." AND ".$to_date."
                    AND TrangThai = 'Đã giao'");
    }

    public function getOrdersByMonth($from_month, $to_month){
        return DB::select("SELECT * FROM donhang WHERE (YEAR(NgayNhanHang) BETWEEN YEAR('".$from_month."') AND YEAR('".$to_month."'))
                    AND (MONTH(NgayNhanHang) BETWEEN MONTH('".$from_month."') AND MONTH('".$to_month."')) AND TrangThai = 'Đã giao'");
    }

    public function getOrdersByYear($from_year, $to_year){
        return DB::select("SELECT * FROM donhang WHERE (YEAR(NgayNhanHang) BETWEEN '".$from_year."' AND '".$to_year."')
                    AND TrangThai = 'Đã giao'");
    }
}
