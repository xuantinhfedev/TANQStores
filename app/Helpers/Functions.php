<?php
    use App\Models\DanhMuc;
    use App\Models\TheLoai;

    function getAllDanhMuc(){
        $danhmuc = new DanhMuc();
        return $danhmuc->getAllDanhMuc();
    }

    function getAllTheLoai(){
        $theloai = new TheLoai();
        return $theloai->getAllTheLoai();
    }
?>