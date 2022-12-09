<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ThongKe;

class ThongKeController extends Controller
{
    private $orders;

    public function __construct()
    {
        $this->orders = new ThongKe();
    }

    public function index(Request $request){

        $chart_data = '';

        if (empty($request->option)){
            $from_month = '2022-01';
            $to_month = '2022-12';

            $arr_from = explode('-', $from_month);
            $start_year = $arr_from[0];
            $start_month = $arr_from[1];
            $from_month = ''.$arr_from[0].'/'.$arr_from[1].'/01';
            
            $arr_to = explode('-', $to_month);
            $end_year = $arr_to[0];
            $end_month = $arr_to[1];
            $to_month = ''.$arr_to[0].'/'.$arr_to[1].'/01';

            $allOrders = $this->orders->getOrdersByMonth($from_month, $to_month);
            
            for ($y = $start_year; $y <= $end_year; $y++){
                if ($y == $start_year && $y == $end_year){
                    for ($m = $start_month; $m <= $end_month; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
                else if ($y == $start_year && $y != $end_year){
                    for ($m = $start_month; $m <= 12; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
                else if ($y == $end_year && $y != $start_year){
                    for ($m = 1; $m <= $end_month; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
                else {
                    for ($m = 1; $m <= 12; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
            }
            $chart_data = substr($chart_data, 0, -2);
        }
        else if ($request->option == '1'){
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $temp1 = $from_date;
            $temp2 = $to_date;

            if ($from_date > $to_date){
                return redirect()->route('thongke')->with('msg', 'Khoảng thời gian không hợp lệ');
            }

            $arr_from = explode('-', $from_date);
            $start_year = $arr_from[0];
            $start_month = $arr_from[1];
            $start_day = $arr_from[2];
            $from_date = ''.$arr_from[0].$arr_from[1].$arr_from[2];
            
            $arr_to = explode('-', $to_date);
            $end_year = $arr_to[0];
            $end_month = $arr_to[1];
            $end_day = $arr_to[2];
            $to_date = ''.$arr_to[0].$arr_to[1].$arr_to[2];

            $allOrders = $this->orders->getOrdersByDate($from_date, $to_date);

            $from_date = $temp1;
            $to_date = $temp2;
            $day = $from_date;

            while (true){
                $revenue = 0;
                foreach($allOrders as $key=>$item){
                    $arr = explode(' ', $item->NgayNhanHang);
                    if ($day == $arr[0]){
                        $revenue += $item->TongTien;
                    }
                }

                $chart_data .= "{ date:'".$day."', profit:".$revenue."}, ";

                if ($day == $to_date){
                    break;
                } else {
                    $day = date('Y-m-d', strtotime($day. ' + 1 days'));
                }
            }
            
            $chart_data = substr($chart_data, 0, -2);
        }
        else if ($request->option == '2'){
            $from_month = $request->from_month;
            $to_month = $request->to_month;

            if ($from_month > $to_month){
                return redirect()->route('thongke')->with('msg', 'Khoảng thời gian không hợp lệ');
            }

            $arr_from = explode('-', $from_month);
            $start_year = $arr_from[0];
            $start_month = $arr_from[1];
            $from_month = ''.$arr_from[0].'/'.$arr_from[1].'/01';
            
            $arr_to = explode('-', $to_month);
            $end_year = $arr_to[0];
            $end_month = $arr_to[1];
            $to_month = ''.$arr_to[0].'/'.$arr_to[1].'/01';

            $allOrders = $this->orders->getOrdersByMonth($from_month, $to_month);

            for ($y = $start_year; $y <= $end_year; $y++){
                if ($y == $start_year && $y == $end_year){
                    for ($m = $start_month; $m <= $end_month; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
                else if ($y == $start_year && $y != $end_year){
                    for ($m = $start_month; $m <= 12; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
                else if ($y == $end_year && $y != $start_year){
                    for ($m = 1; $m <= $end_month; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
                else {
                    for ($m = 1; $m <= 12; $m++){
                        $revenue = 0;
                        foreach($allOrders as $key => $item){
                            $date = $item->NgayNhanHang;
                            $arrDate = explode('-', $date);
                            if ($arrDate[0] == $y && $arrDate[1] == $m){
                                $revenue += $item->TongTien;
                            }
                        }
                        $month_year = $m . '/' . $y;
                        $chart_data .= "{ date:'".$month_year."', profit:".$revenue."}, ";
                    }
                }
            }
            $chart_data = substr($chart_data, 0, -2);
        }
        else {
            $from_year = $request->from_year;
            $to_year = $request->to_year;

            if ($from_year > $to_year){
                return redirect()->route('thongke')->with('msg', 'Khoảng thời gian không hợp lệ');
            }

            $allOrders = $this->orders->getOrdersByYear($from_year, $to_year);
            
            for ($y = $from_year; $y <= $to_year; $y++){
                $revenue = 0;
                foreach($allOrders as $key => $item){
                    $date = $item->NgayNhanHang;
                    $arrDate = explode('-', $date);
                    
                    if ($arrDate[0] == $y){
                        $revenue += $item->TongTien;
                    }
                }
                $chart_data .= "{ date:'".$y."', profit:".$revenue."}, ";
            }
            $chart_data = substr($chart_data, 0, -2);
        }

        return view('admin.thongke', compact('chart_data'));
    }

}
