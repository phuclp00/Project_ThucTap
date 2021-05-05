<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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
		$hdon =DB::table('hoadon')->join('dienke', 'hoadon.madk','=','dienke.madk')
        ->join('khachhang', 'dienke.makh','=','khachhang.makh')->where('mahd',$mahd)->get();
		foreach($hdon as $key => $hd){
			$mahd = $hd->mahd;
			$madk = $hd->madk;
            $makh = $hd->makh;
		}
		$dienke = DB::table('dienke')->where('madk',$madk)->first();
        $hoadon=DB::table('hoadon')->where('mahd',$mahd)->first();
        $khachhang=DB::table('khachhang')->where('makh', $makh)->first();
        $output = '';
		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		
		</style>
		<h1><center>Công Ty Điện Lực Hồ Chí Minh</center></h1>
		<h4><center>Hóa Đơn Tính Tiền Điện</center></h4>
			<table class="table-styling">
                <tr>
                    <th>Mã hóa đơn</th>
                    <td>'.$hoadon->mahd.'</td>
                </tr>
                <tr>
                    <th>Mã điện kế</th>
                    <td>'.$dienke->madk.'</td>
                </tr>
                <tr>
                    <th>Mã khách hàng</th>
                    <td>'.$khachhang->makh.'</td>
                </tr>
                <tr>
                    <th>Tên khách hàng</th>
                    <td>'.$khachhang->tenkh.'</td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>'.$khachhang->diachi.'</td>
                </tr>
                <tr>
                    <th>Kỳ</th>
                    <td>'.$hoadon->ky.'</td>
                </tr>
                <tr>
                    <th>Từ ngày</th>
                    <td>'.$hoadon->tungay.'</td>
                </tr>
                <tr>
                    <th>Đến ngày</th>
                    <td>'.$hoadon->denngay.'</td>
                </tr>
                <tr>
                    <th>Chỉ số đầu</th>
                    <td>'.$hoadon->chisodau.'</td>
                </tr>
                <tr>
                    <th>Chỉ số cuối</th>
                    <td>'.$hoadon->chisocuoi.'</td>
                </tr>
                <tr>
                    <th>Điện năng tiêu thụ</th>
                    <td>'.($hoadon->chisocuoi-$hoadon->chisodau).'</td>
                </tr>
                <tr>
                    <th>Tổng thành tiền</th>
                    <td>'.$hoadon->tongthanhtien.'</td>
                </tr>
                <tr>
                    <th>Ngày lập hóa đơn</th>
                    <td>'.$hoadon->ngaylaphd.'</td>
                </tr>
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
    public function tinhtien(Request $req)
    {
        $madk = $req->madk;
        $hoadon = DB::table('hoadon')->where('madk',$madk)->first();
        $chisodau= $hoadon != null ? $hoadon->chisodau : 0;
        if($req->chisocuoi > $chisodau)
            $sokw = $req->chisocuoi - $chisodau;
        else
            return redirect()->route('hoadon');
        $sotien=0;
        $bac1= 1242;
        $bac2 =1304;
        $bac3 = 1651;
        $bac4 = 1788;
        $bac5= 1912;
        $bac6= 1962;
        if ($sokw <= 100)
            $sotien =$sokw*$bac1;
        else if ($sokw>100  && $sokw <= 150)
        {
            $sotien= 100*$bac1 + ($sokw-100)*$bac2;
        }
        else if($sokw > 150 && $sokw <= 200){
            $sotien= 100*$bac1 + 50*$bac2 + ($sokw - 150)*$bac3;
        }
        else if ($sokw > 200 && $sokw <= 300)
        {
            $sotien= 100*$bac1 + 50*$bac2 + 50*$bac3 + ($sokw-200)*$bac4;
        }
        else if ($sokw > 300 && $sokw <= 400)
        {
            $sotien= 100*$bac1 + 50*$bac2 + 50*$bac3 + 100*$bac4 + ($sokw-300)*$bac5;
        }
        else{
            $sotien= 100*$bac1 + 50*$bac2 + 50*$bac3 + 100*$bac4 + 100*$bac5 + ($sokw-400)*$bac6;
        }
        if($hoadon != null)
        {
            DB::table('hoadon')->where('madk',$madk)->update(
                [
                    'chisocuoi' => $req->chisocuoi,
                    'tongthanhtien' => $sotien
                ]);            
        } else {
            DB::table('hoadon')->insert([
                'mahd'=>$req->mahd,
                'madk'=>$req->madk,
                'ky'=>$req->ky,
                'tungay'=>$req->tungay,
                'denngay'=>$req->Carbon::now(),
                'chisodau'=>$req->chisodau,
                'chisocuoi'=>$req->chisocuoi,
                'tongthanhtien'=>$req->tongthanhtien,
                'ngaylaphd'=>$req->Carbon::now(),
                'tinhtrang'=>$req->tinhtrang,
                'create_at'=>$req->Carbon::now(),
                'create_by'=>Auth::user()->name,
            ]);
        }

        return redirect()->route('hoadon');
    } 
}
