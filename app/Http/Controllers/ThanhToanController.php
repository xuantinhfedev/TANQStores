<?php

namespace App\Http\Controllers;
use App\Models\LayDanhMuc;
use App\Models\LayTheLoai;
use App\Models\GioHang;
use App\Models\LayTaiKhoan;
use App\Models\SanPham;
use App\Models\Orders;
use App\Models\taikhoan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ThanhToanController extends Controller
{
    public function __construct()
    {
        $this->SanPham = new SanPham();
    }
    public function goToThanhToan(Request $request){

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        // dd(session()->get('cart'));
        $TenTK = $request->session()->get('TenTaiKhoan');
        $tk = new taikhoan();
        $taikhoan = null;
        $SP = null;
        if((session()->has('TenTaiKhoan'))){
            $loaigio = 'GH';
            $cart = json_decode((Storage::disk('local')->get(session()->get('TenTaiKhoan').'.txt')), true);
            session()->put($loaigio, $cart);
            // dd((session('GH')));
            $taikhoan = $tk->layThongTinKH($TenTK);
        }
        else
            $loaigio = 'cart';
        if(session($loaigio)){
            foreach(session($loaigio) as $id => $item){
                $SP[$id] = [$this->SanPham->getCT($id), $this->SanPham->GetSanPham($this->SanPham->GetIDSP($id)[0]->MaSP),"SoLuong"=>$item["SoLuong"]];
            }

        }

        // dd($SP);
        return view("ThanhToan", compact('taikhoan','theloai','danhmuc', 'SP'));
    }
    public function DatHangNgay(Request $request){
        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();

        // dd(session()->get('cart'));
        $TenTK = $request->session()->get('TenTaiKhoan');
        $tk = new taikhoan();
        $taikhoan = null;
        $SP = null;
        if((session()->has('TenTaiKhoan'))){
            $loaigio = 'GH';
            // $cart = json_decode((Storage::disk('local')->get(session()->get('TenTaiKhoan').'.txt')), true);
            // session()->put($loaigio, $cart);
            // dd((session('GH')));
            $taikhoan = $tk->layThongTinKH($TenTK);

        }
        else
            $loaigio = 'cart';
        $CTSP = $this->SanPham->getCTSPID($request->MaSP, $request->Size);
        
        if($this->SanPham->LaySoLuong($CTSP) <= 0)
            return redirect()->back()->with('msg', 'Số lượng yêu cầu  không có sẵn');   

        else{
            $SP[0] = [$this->SanPham->getCT($CTSP), $this->SanPham->GetSanPham($this->SanPham->GetIDSP($CTSP)[0]->MaSP),"SoLuong"=>$request->SoLuong];
            $DHN = 1;
            // dd($SP);
            return view("ThanhToan", compact('taikhoan','theloai','danhmuc', 'SP', 'DHN'));

        }
    }
    public function insertDH(Request $request){
        $rule = [
            'name' => 'required|min:5',
            'DiaChi' => 'required',
            'diaChiNhanHang' => 'required|min:20',
            'phoneNum' => 'numeric|min:10',
            'ghiChu' => 'required'
        ];
        $message = [
            'required' => ':attribute không được để trống !',
            'min' => ':attribute phải có ít nhất :min kí tự !',
            'numeric' => ':attribute không đúng định dạng !'
        ];

        $request->validate($rule,$message);
        if((session()->has('TenTaiKhoan'))){

            $tk = new LayTaiKhoan();
            $TenTK = $request->session()->get('TenTaiKhoan');
            $taikhoan = $tk->GETIDTK($TenTK);
            $MaTK = ($taikhoan[0]->MaTK);
        }else{
            $MaTK = 16;
        }
        // dd($request->name);
        $order = new Orders();
        $dsdh[] = $order->layDSDH();
        $key = count($dsdh[0]);
        //DD($dsdh);
        if(count($dsdh) > 0){
            $madh = 'DH'.time();
        }
        else
            $madh = 'DH1';
        $ngayDatHang = date('Y-m-d',time());
        $ngayNhanHang = date('Y-m-d',time() + 5*24*60*60);
        $hinhThucVanChuyen = 'COD';
        $data = [
            $madh,
            $request->name,
            $ngayDatHang,
            $hinhThucVanChuyen,
            $ngayNhanHang,
            $request->diaChiNhanHang,
            $request->phoneNum,
            $request->ghiChu,
            $MaTK,
            $request->tongTien,
            $trangthai = 'Chưa giao'
        ];
        $order->insertDH($data);
        
        if(!isset($request->DHN)){
            $listSP[] = $request->session()->get('SP');
            if(isset($listSP[0]["LoaiGio"])){
                $loaigio = $listSP[0]["LoaiGio"];
                unset($listSP[0]["LoaiGio"]);
            }
        }else{
            $listSP[] = $request->session()->get('DHN');
        }

        // DD($loaigio);

        foreach($listSP[0] as $SP){
            // DD($SP);
            $chiTietSPID = $SP[0]->ChiTietSPID;
            $soLuong = $SP["SoLuong"];
            $giaBan = $SP[1]->GiaBan;
            $datactdh = [
                $madh,
                $chiTietSPID,
                $soLuong,
                $giaBan
            ];
            $order->insertCTDH($datactdh);
            $SoLuongCon = $this->SanPham->LaySoLuong($chiTietSPID);
            $this->SanPham->SetSoLuong($chiTietSPID,$SoLuongCon-$soLuong);
        }
        
        $request->session()->forget('SP');
        if(isset($loaigio)){
            if($loaigio == "GH"){
                Storage::disk('local')->put(session()->get('TenTaiKhoan').'.txt', json_encode(''));
                $request->session()->forget('GH');
                // session()->put('GH', "abc");
            }elseif($loaigio == "cart"){
                $request->session()->forget('cart');
            }

        }


        return view('ThongBao',compact('madh'));
    }
}
