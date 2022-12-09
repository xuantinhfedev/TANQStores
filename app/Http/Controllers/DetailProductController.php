<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetailProduct;
use Illuminate\Validation\Rule;

class DetailProductController extends Controller
{
    private $product;
    public function __construct()
    {
        $this->product = new DetailProduct();
    }

    public function index(Request $request, $id){
        $title = 'Chi tiết sản phẩm';

        //$request->session()->put('id', $id);

        $detailList = $this->product->getAllDetail($id);

        return view('admin.productDetails.list', compact('title', 'id', 'detailList'));
    }

    public function add($id){
        $title = 'Thêm size';

        return view('admin.productDetails.add', compact('title', 'id'));
    }

    public function handleAdd(Request $request, $id){
        $size = $request->size;
        $productID = $id < 10 ? '0'.$id : $id;
        $chiTietSP = 'CTSP' . $productID;
        
        $numberOfSize = count($this->product->getAllDetail($id)) + 1;
        if ($numberOfSize < 10){
            $numberOfSize = '0'.$numberOfSize;
        }
        $chiTietID = 'CTSP' . $productID . $numberOfSize;
        
        $request->validate([
            'quantity' => 'required|regex:/^[0-9]+$/',
        ], [
            'quantity.required' => 'Số lượng còn không được để trống',
            'quantity.regex' => 'Số lượng còn phải là số',
        ]);

        //Nếu chưa tồn tại size thì thêm mới ngược lại cộng dồn vào size đã tồn tại
        if (count($this->product->getDetailByID($chiTietSP, $size)) == 0){
            $dataInsert = [
                $chiTietID,
                $request->size,
                $request->quantity,
                $id,
            ];
            $this->product->addDetailProduct($dataInsert);
        } else {
            $detailProduct = $this->product->getDetailByID($chiTietSP, $size);
            foreach($detailProduct as $key=>$item){
                $CTSPID = $item->ChiTietSPID;
                $quantity = $item->SoLuongCon;
            }
            $ChangedQuantity = $request->quantity + $quantity;
            $dataUpdate = [
                $request->size,
                $ChangedQuantity,
            ];
            $this->product->updateDetailProduct($dataUpdate, $CTSPID);
        }

        return redirect(route('products.details.index', $id))->with('msg', 'Thêm size thành công');
    }

    public function getEdit(Request $request, $id, $detailID=0){
        $title = 'Cập nhật size';

        if (!empty($detailID)){
            $productDetail = $this->product->getDetailProduct($detailID);
            if (!empty($productDetail[0])){

                $request->session()->put('detailID', $detailID);    //Lưu id vào 1 session để khi thực hiện cập nhật có thể lấy ra id
                $productDetail = $productDetail[0];
                
            } else {
                return redirect()->route('products.details.index', $id)->with('msg', 'Chi tiết sản phẩm không tồn tại');
            }
        } else {
            return redirect()->route('products.details.index', $id)->with('msg', 'Liên kết không tồn tại');
        }

        return view('admin.productDetails.edit', compact('title', 'productDetail', 'id'));
    }

    public function handleEdit(Request $request, $id){
        $detailID = session('detailID');
        if (empty($detailID)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $request->validate([
            'quantity' => 'required|regex:/^[0-9]+$/',
        ], [
            'quantity.required' => 'Số lượng còn không được để trống',
            'quantity.regex' => 'Số lượng còn phải là số',
        ]);
        $productID = $id < 10 ? '0'.$id : $id;
        $numberOfSize = count($this->product->getAllDetail($id)) + 1;
        if ($numberOfSize < 10){
            $numberOfSize = '0'.$numberOfSize;
        }
        $chiTietID = 'CTSP' . $productID . $numberOfSize;

        $dataUpdate = [
            $request->size,
            $request->quantity,
        ];
        $this->product->updateDetailProduct($dataUpdate, $detailID);

        return back()->with('msg', 'Cập nhật size thành công');
    }

    public function delete($id, $detailID=0){
        if (!empty($detailID)){
            //Kiểm tra xem sản phẩm có tồn tại hay không
            $productDetail = $this->product->getDetailProduct($detailID);
            if (!empty($productDetail[0])){
                
                $status = $this->product->deleteDetailProduct($detailID);
                if ($status){
                    $msg = 'Xóa chi tiết sản phẩm thành công';
                } else {
                    $msg = 'Bạn không thể xóa chi tiết sản phẩm lúc này. Vui lòng thử lại sau';
                }

            } else {
                $msg = 'Chi tiết sản phẩm không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('products.details.index', $id)->with('msg', $msg);
    }
}
