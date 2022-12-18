<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    public $SanPham = null;
    public $Gia = 0;

    public function __construct($GH)
    {
        if($GH){
            $this->SanPham = $GH->SanPham;
            $this->Gia = $GH->Gia;
        }
    }
    public function ThemGH($IDSP){
        $newSP = ['SL'=>1];
        // dd($IDSP);
        $this->SanPham[$IDSP] = $newSP;
        // dd($SanPham);
        if($this->SanPham){
            if(isset($this->SanPham[$IDSP]))
                $newSP['SL'] += 1;

                // $this->SoLuong='1';
        }
        $this->SanPham[$IDSP]=$newSP;
        $this->Gia = 1;
        // $SPM['SoLuong']++;
        // $this->SanPham[$IDSP] = $SPM;
        // $this->SoLuong += $SPM['SoLuong'];
    }
}
