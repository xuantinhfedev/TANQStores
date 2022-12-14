<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LaySanPham;
use App\Models\LayTheLoai;
use App\Models\taikhoan;
use App\Models\LayDanhMuc;
class OrdersController extends Controller
{
    private $orders;
    public function __construct()
    {
        $this->orders = new Orders();
    }

    public function index(Request $request){
        $title = 'Danh sách đơn hàng';

        $status = '';
        $dates = [];

        if (!empty($request->from_date)){
            $fromDate = $request->from_date;
            
            $arr = explode('-', $fromDate);

            $dates[] = ''.$arr[0].$arr[1].$arr[2];
        } else {
            $dates[] = '00000000';
        }

        if (!empty($request->to_date)){
            $toDate = $request->to_date;

            $arr = explode('-', $toDate);

            $dates[] = ''.$arr[0].$arr[1].$arr[2];
        } else {
            $dates[] = date('ymd');
        }

        if (!empty($request->status)){
            $status = $request->status;
        }

        if (!empty($request->keywords)){
            $keywords = $request->keywords;
        } else {
            $keywords = '';
        }

        $ordersList = $this->orders->getAllOrders($dates, $status, $keywords);

        return view('admin.orders.list', compact('title', 'ordersList'));
    }
    public function checkdetailView(Request $request){
        

        $ordersList = $this->orders->getDetailAcc(session()->get('TenTaiKhoan'));
        // dd($ordersList);
        return view('ThongTinCaNhan', compact('ordersList'));
    }
    public function XepHangThanhVien(Request $request){
        

        $TTTK = $this->orders->getDetailAccHTV(session()->get('TenTaiKhoan'))[0];
        // dd($TTTK);
        // dd($ordersList);
        return view('ThongTinCaNhan', compact('TTTK'));
    }

    public function detail(Request $request, $id=0){
        $title = 'Chi tiết đơn hàng';

        if (!empty($id)){
            $orderDetail = $this->orders->getDetail($id);
            //Danh sách sản phẩm trong đơn hàng
            $productsList = $this->orders->getProductsInOrder($id);
            
            if (!empty($orderDetail[0])){
                $request->session()->put('id', $id);
                $orderDetail = $orderDetail[0];
            } else {
                return redirect()->route('orders.index')->with('msg', 'Chi tiết đơn hàng không tồn tại');
            }
        } else {
            return redirect()->route('orders.index')->with('msg', 'Liên kết không tồn tại');
        }

        return view('admin.orders.detail', compact('title', 'orderDetail', 'productsList'));
    }
    public function detailView(Request $request, $id=0){
        $title = 'Chi tiết đơn hàng';
        
        if (!empty($request->MaDH)){
            $orderDetail = $this->orders->getDetail($request->MaDH);
            // dd($orderDetail);
            //Danh sách sản phẩm trong đơn hàng
            $productsList = $this->orders->getProductsInOrder($request->MaDH);
            $spnam = new LaySanPham();
            $SanPhamList = $spnam->getAllSanPham_Nam();
    
            $spnu = new LaySanPham();
            $sanphamnu = $spnu->getAllSanPham_Nu();
    
            $tl = new LayTheLoai();
            $theloai = $tl->getAllTheLoai();
    
            $dm = new LayDanhMuc();
            $danhmuc = $dm->getAllDanhMuc();
            if (!empty($orderDetail[0])){
                $request->session()->put('id', $id);
                $orderDetail = $orderDetail[0];
            } else {
                return redirect()->route('KTDonHang')->with('msg', 'Chi tiết đơn hàng không tồn tại');
            }
        } else {
            return redirect()->route('KTDonHang')->with('msg', 'Liên kết không tồn tại');
        }

        return view('KTDonHang', compact('title', 'orderDetail', 'productsList','SanPhamList','sanphamnu','theloai','danhmuc'));
    }
    public function detailUserView($id){
        $title = 'Chi tiết đơn hàng';
        
        if (!empty($id)){
            $orderDetail = $this->orders->getDetail($id);
            // dd($orderDetail);
            //Danh sách sản phẩm trong đơn hàng
            $productsList = $this->orders->getProductsInOrder($id);
            
            if (!empty($orderDetail[0])){
                session()->put('id', $id);
                $orderDetail = $orderDetail[0];
            } else {
                return redirect()->route('CTDH')->with('msg', 'Chi tiết đơn hàng không tồn tại');
            }
        } else {
            return redirect()->route('CTDH')->with('msg', 'Liên kết không tồn tại');
        }

        return view('ChiTietDonHang', compact('title', 'orderDetail', 'productsList'));
    }
    public function delete($id = 0){
        if (!empty($id)){
            $order = $this->orders->getDetail($id);

            if (!empty($order[0])){
                $status = $this->orders->deleteOrder($id);

                if ($status){
                    $msg = 'Xóa đơn hàng thành công';
                } else {
                    $msg = 'Bạn không thể xóa đơn hàng lúc này. Vui lòng thử lại sau';
                }
            } else {
                $msg = 'Đơn hàng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('orders.index')->with('msg', $msg);
        
    }
    public function deleteUser($id = 0){
        if (!empty($id)){
            $order = $this->orders->getDetail($id);
            $order1 = $this->orders->selectCTDH($order[0]->MaDonHang);
            foreach($order1 as $item){
                $chiTietSPID = $item->ChiTietSPID;
                $sp = new SanPham();
                $SoLuongCon = $sp->LaySoLuong($chiTietSPID);
                $sp->SetSoLuong($chiTietSPID,$SoLuongCon+$item->SoLuong);
            }
            if (!empty($order[0])){
                $status = $this->orders->deleteOrder($id);
                if ($status){
                    $msg = 'Xóa đơn hàng thành công';
                } else {
                    $msg = 'Bạn không thể xóa đơn hàng lúc này. Vui lòng thử lại sau';
                }
            } else {
                $msg = 'Đơn hàng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('KTDonHang')->with('msg', $msg);
        
    }
    public function deleteUserLogin($id = 0){
        if (!empty($id)){
            $order = $this->orders->getDetail($id);
            $order1 = $this->orders->selectCTDH($order[0]->MaDonHang);
            foreach($order1 as $item){
                $chiTietSPID = $item->ChiTietSPID;
                $sp = new SanPham();
                $SoLuongCon = $sp->LaySoLuong($chiTietSPID);
                $sp->SetSoLuong($chiTietSPID,$SoLuongCon+$item->SoLuong);
            }
            if (!empty($order[0])){
                $status = $this->orders->deleteOrder($id);
                if ($status){
                    $msg = 'Xóa đơn hàng thành công';
                } else {
                    $msg = 'Bạn không thể xóa đơn hàng lúc này. Vui lòng thử lại sau';
                }
            } else {
                $msg = 'Đơn hàng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('KTDHview')->with('msg', $msg);
        
    }

    public function update(Request $request){
        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        // dd($request->all());
        $updateData = [$request->status];
        $this->orders->updateStatus($updateData, $id);
        if($request->status=="Đã giao"){
            $tk = new taikhoan();
            $tk->updateTieuDung($request->MaTK, $request->TongTien);
        }

        return back()->with('msg', 'Cập nhật trạng thái thành công');
    }
}
