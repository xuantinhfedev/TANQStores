<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\SanPham;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\LaySanPham;
use App\Models\LayTheLoai;
use App\Models\LayDanhMuc;
class GioHangController extends Controller
{
    public function __construct()
    {
        $this->SanPham = new SanPham();
    }
    public function index(){
        // dd(session()->get('cart'));
        $SP = null;
        if((session()->has('TenTaiKhoan'))){
            $loaigio = 'GH';
            $cart = json_decode((Storage::disk('local')->get(session()->get('TenTaiKhoan').'.txt')), true);
            session()->put($loaigio, $cart);
            // dd((session('GH')));
        }
        else
            $loaigio = 'cart';
        if(session($loaigio)){
            $products = session()->pull($loaigio, []); // Second argument is a default value

            foreach($products as $id => $item){
                // dd($id);
                // dd($products);
                // dd(($this->SanPham->LaySoLuong($id)));
                // xử lý quyên hết hàng tại giỏ hàng
                // dd()
                // dd($item);
                //  dd($item['SoLuong']);
                if($this->SanPham->LaySoLuong($id) < $item['SoLuong']){
                    unset($products[$id]);
                    // dd(session($loaigio));
                }else
                    $SP[$id] = [$this->SanPham->getCT($id), $this->SanPham->GetSanPham($this->SanPham->GetIDSP($id)[0]->MaSP),"SoLuong"=>$item["SoLuong"]];
                
            }
            session()->put($loaigio, $products);
            // dd(session($loaigio));
        }
        // dd($SP);
        $spnam = new LaySanPham();
        $SanPhamList = $spnam->getAllSanPham_Nam();

        $spnu = new LaySanPham();
        $sanphamnu = $spnu->getAllSanPham_Nu();

        $tl = new LayTheLoai();
        $theloai = $tl->getAllTheLoai();

        $dm = new LayDanhMuc();
        $danhmuc = $dm->getAllDanhMuc();
        return view('GioHang', compact("SP",'SanPhamList','sanphamnu','theloai','danhmuc'));
    }
    public function ThemGH(Request $req, $id){
        $ma = DB::table('chitietsanpham')->where('MaSP', $id)->get('ChiTietSPID')[0]->ChiTietSPID;
        // dd($ma);
        if($ma !=null){
                $GHC = Session('GH')?Session('GH') : null;
                $GHM = new GioHang($GHC);
                $GHM->ThemGH($ma);

                $req->session()->put('GH',$GHM);
                $data = session()->get('GH');
            }
        return view('GioHang', compact('sl'));
        
    }
    public function addToCart(Request $request)
    {
        if((session()->has('TenTaiKhoan')))
            $loaigio = 'GH';
        else
            $loaigio = 'cart';

            // dd($loaigio);
        // $ma = DB::table('chitietsanpham')->where('MaSP', $id)->get('ChiTietSPID')[0]->ChiTietSPID;
        $id =  $this->SanPham->getCTSPID($request->json('MaSP'), $request->json('Size'));
        if(session()->has($loaigio)){
            $cart = session()->get($loaigio, []);

        }
        else $cart = session()->get($loaigio, []);
        // return response()->json([$cart],200);
        $slCon = ($this->SanPham->getCT($id))->SoLuongCon;
        $slthem = $request->json('SoLuong');

        if(isset($cart[$id])) {
            $slco = $cart[$id]['SoLuong'] + $slthem;
            if($slco<$slCon){
                $cart[$id]['SoLuong']+=$request->json('SoLuong');
                session()->put($loaigio, $cart);
                $sl = count(Session($loaigio));
                if((session()->has('TenTaiKhoan')))
                {
                    Storage::disk('local')->put(session()->get('TenTaiKhoan').'.txt', json_encode(Session($loaigio)));
                }
                return response()->json([$sl],200);
            }
            else return response()->json(["400"],400);

        } else {
            if($slthem<=$slCon){
                // return response()->json([$cart],200);
                $cart[$id] = [
                    "SoLuong" => $request->json('SoLuong')
                ];
                // 
                
                // return response()->json([($cart)],200);
                session()->put($loaigio, $cart);

                $sl = count(Session($loaigio));

                if((session()->has('TenTaiKhoan')))
                {
                    Storage::disk('local')->put(session()->get('TenTaiKhoan').'.txt', json_encode(Session($loaigio)));
                }
        // dd(( (array)json_decode((Storage::disk('local')->get('example.txt')))));
                return response()->json([$sl],200);
            }else return response()->json(["403"],400);
        }




    }
    public function update(Request $request)
    {
        if((session()->has('TenTaiKhoan')))
            $loaigio = 'GH';
        else
            $loaigio = 'cart';
        $id =  $request->json('ID');
        $sl = $request->json('SL');
        $slCon = ($this->SanPham->getCT($id))->SoLuongCon;
        if($sl<=$slCon){
            $cart = session()->get($loaigio);
            $cart[$id]["SoLuong"] = $sl;
            session()->put($loaigio, $cart);
            if((session()->has('TenTaiKhoan')))
                {
                    Storage::disk('local')->put(session()->get('TenTaiKhoan').'.txt', json_encode(Session($loaigio)));
                }
            return response()->json([" "],200);
        }
        else
            return response()->json(400);
        // if($request->id && $request->quantity){
        //     $cart = session()->get('cart');
        //     $cart[$request->id]["quantity"] = $request->quantity;
        //     session()->put('cart', $cart);
        //     session()->flash('success', 'Cart updated successfully');
        // }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        $id =  $request->json('ID');
        if((session()->has('TenTaiKhoan')))
            $loaigio = 'GH';
        else
            $loaigio = 'cart';
        if($request) {
            $cart = session()->get($loaigio);
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put($loaigio, $cart);
                if((session()->has('TenTaiKhoan')))
                {
                    Storage::disk('local')->put(session()->get('TenTaiKhoan').'.txt', json_encode(Session($loaigio)));
                }
            }
            session()->flash('success', 'Product removed successfully');
        }
        return response()->json([$id],200);
    }
}
