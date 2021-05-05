<?php

namespace App\Http\Controllers;

use App\Http\Requests\DienKe\StoreDienKeRequest;
use App\Http\Requests\DienKe\UpdateDienKeRequest;
use App\Models\DienKe;
use App\Models\KhachHangModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DienkeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DienKe::all()->load('khachhang');
        $kh_list = KhachHangModel::all();
        return view('mycomponent.dienke', ['data' => $data, 'kh_list' => $kh_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDienKeRequest $request)
    {
        try {
            $validate = Carbon::parse($request->ngaysx)->format('Y-m-d');
            $validate_nlap = Carbon::parse($request->ngaylap)->format('Y-m-d');
            DienKe::create([
                'madk' => $request->madk,
                'makh' => $request->makh,
                'mota' => $request->mota,
                'trangthai' => $request->trangthai == "1" ? 1 : 0,
                'ngaysx' => $validate,
                'ngaylap' => $validate_nlap,
                'create_by' => Auth::user()->name,
            ]);
            return back()->with('message', 'Thêm thành công ');
        } catch (Exception $e) {
            return back()->with('message', 'Thêm thất bại' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DienKe  $dienKe
     * @return \Illuminate\Http\Response
     */
    public function show(DienKe $dienKe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DienKe  $dienKe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = DienKe::where('madk', $id)->get();
        $kh_list = KhachHangModel::all();
        $view = \view('components.dienke_popup', ['edit_item' => $result, 'kh_list' => $kh_list])->render();
        return response()->json($view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DienKe  $dienKe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDienKeRequest $request)
    {
        $dienKe = DienKe::where('madk', $request->__put)->first();
        if (
            $request->madk == $dienKe->madk &&
            $dienKe->makh == $request->makh &&
            $dienKe->mota == $request->mota &&
            $dienKe->trangthai == $request->trangthai &&
            $dienKe->ngaysx == $request->ngaysx &&
            $dienKe->ngaylap == $request->ngaylap
        ) {
            $dienKe->update_by = Auth::user()->name;
            $dienKe->save();
            return back()->with('message', 'Bạn chưa thay đổi giá trị nào của đối tượng này !');
        } else {
            $request->madk = $dienKe->madk;
            $dienKe->makh = $request->makh;
            $dienKe->mota = $request->mota;
            $dienKe->trangthai = $request->trangthai == "1" ? 1 : 0;
            $dienKe->ngaysx = $request->ngaysx;
            $dienKe->ngaylap = $request->ngaylap;
            $dienKe->update_by = Auth::user()->name;
            $dienKe->save();
            return back()->with('message', 'Cập nhật thành công !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DienKe  $dienKe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DienKe::destroy($id);
        return back()->with('message', 'Xóa thành công ');
    }
}
