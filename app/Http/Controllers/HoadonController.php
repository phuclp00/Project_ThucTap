<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class HoadonController extends Controller
{
    public function all_hoadon(){
        $all_hoadon=DB::table('hoadon')->join('dienke', 'hoadon.madk','=','dienke.madk')
        ->join('khachhang', 'dienke.makh','=','khachhang.makh')->get();
        $all_kh=DB::table('khachhang')->join('dienke', 'dienke.makh','=','khachhang.makh')->get();
        return view('mycomponent.hoadon',['hoadon'=>$all_hoadon, 'all_kh'=>$all_kh]);
    }
    public function all_dk(){
        $all_dk = DB::table('dienke')->join('khachhang','dienke.makh','=', 'khachhang.makh')->get();
        return view('mycomponent.hoadon',['dienke'=>$all_dk]);
    }
    public function print_hoadon($mahd){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_hoadon_convert($mahd));
		
		return $pdf->stream();
	}
    public function print_hoadon_convert($mahd){
		$hdon =DB::table('hoadon')->where('madh',$mahd)->get();
		foreach($hdon as $key => $hd){
			$mahd = $hd->mahd;
			$madk = $hd->madk;
            // $ky = $hd->ky;
            // $tungay = $hd->tungay;
            // $denngay = $hd->denngay;
            // $chisodau = $hd->chisodau;
            // $chisocuoi = $hd->chisocuoi;
            // $tongthanhtien = $hd->tongthanhtien;
            // $ngaylaphoadon = $hd->ngaylaphoadon;
		}
        // ->where('ky',$ky)
        // ->where('tungay', $tungay)->where('denngay', $denngay)->where('chisodau', $chisodau)
        // ->where('chisocuoi', $chisocuoi)->where('tongthanhtien', $tongthanhtien)
        // ->where('ngaylaphoadon', $ngaylaphoadon)
        // ->where('tenkh', $tenkh)->where('diachi', $diachi)
		$dienke = DB::table('dienke')->where('madk',$madk)->first();
        $hoadon=DB::table('hoadon')->where('madh',$mahd)->first();
		$data_kh=DB::table('dienke')->join('khachhang','dienke.makh','=', 'khachhang.makh')->get();
        foreach($data_kh as $key => $data){
			$makh = $data->makh;
			// $tenkh=$data->tenkh;
            // $diachi=$data->diachi;
		}
        $khachhang=DB::table('khachhang')->where('makh', $makh)->first();
        $output = '';
		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><center>Công ty Điện Lực Hồ Chí Minh</center></h1>
		<h4><center>Hóa Đơn Tính Tiền Điện</center></h4>
			<table class="table-styling">
				<thead>
					<tr>
                    <th>Mã hóa đơn</th>
                    <th>Mã điện kế</th>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Kỳ</th>
                    <th>Từ ngày</th>
                    <th>Đến ngày</th>
                    <th>Chỉ số đầu</th>
                    <th>Chỉ số cuối</th>
                    <th>Tổng thành tiền</th>
                    <th>Ngày lập hóa đơn</th>
					</tr>
				</thead>
				<tbody>';
                    $output.='		
                        <tr>
                            <td>'.$hoadon->mahd.'</td>
                            <td>'.$dienke->madk.'</td>
                            <td>'.$khachhang->makh.'</td>
                            <td>'.$khachhang->tenkh.'</td>
                            <td>'.$khachhang->diachi.'</td>
                            <td>'.$hoadon->ky.'</td>
                            <td>'.$hoadon->tungay.'</td>
                            <td>'.$hoadon->denngay.'</td>
                            <td>'.$hoadon->chisodau.'</td>
                            <td>'.$hoadon->chisocuoi.'</td>
                            <td>'.$hoadon->tongthanhtien.'</td>
                            <td>'.$hoadon->ngaylaphoadon.'</td>
                        </tr>';
                    $output.='
                </tbody>
	
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Khách hàng</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

	}
    // function tinhtien($sokw)
    // {
    //     $muc1=$muc2=$muc3=$muc4=$muc5=$muc6=0;
    //     if ($sokw>100)
    //         $muc1 = 100*1242;
    //     else $muc1= $sokw*1242;
    //     if ($sokw>100 )
    //     {
    //         if ($sokw>150) $muc2=50*1304;
    //         else $muc2=($sokw-100)*1304;
    //     }
    //     if ($sokw>150 )
    //     {
    //         if ($sokw>200) $muc2=50*1651;
    //         else $muc3=($sokw-150)*1651;
    //     }
    //     if ($sokw>200 )
    //     {
    //         if ($sokw>300) $muc2=50*1788;
    //         else $muc4=($sokw-200)*1788;
    //     }
    //     if ($sokw>300 )
    //     {
    //         if ($sokw>400) $muc2=50*1912;
    //         else $muc5=($sokw-400)*1912;
    //     }
    //     if ($sokw>400 )
    //     {
    //         $muc6=($sokw-400)*1962;
    //     }
        
    //     return $sotien;
    // }
}
