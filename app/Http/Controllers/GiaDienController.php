<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiaDien\StoreGiaDientRequest;
use App\Http\Requests\GiaDien\UpdateGiaDientRequest;
use App\Models\GiaDien;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GiaDienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://download.vn/bieu-gia-dien-ban-le-35711';
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $data = $crawler->filter('div >div >div > table')->html();
        $title = $crawler->filter('div >div >div > p')->html();
        $content = $crawler->filter('div >div >div >ul')->eq(1)->html();
        return view('mycomponent.giadien', ['data' => $data, 'title' => $title, 'content' => $content]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGiaDientRequest $request)
    {
        $validate = Carbon::parse($request->ngayapdung)->format('Y-m-d');

        GiaDien::create([
            'mabac' => $request->mabac,
            'tenbac' => $request->mota,
            'tusokw' => $request->star,
            'densokw' => $request->end,
            'dongia' => $request->dongia,
            'ngayapdung' => $validate,
            'create_by' => Auth::user()->name
        ]);
        return back()->with('message', 'Thêm thành công ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiaDien  $giaDien
     * @return \Illuminate\Http\Response
     */
    public function show(GiaDien $giaDien)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiaDien  $giaDien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = GiaDien::where('mabac', $id)->get();
        $view = \view('components.giadien_popup', ['edit_item' => $result])->render();
        return response()->json($view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiaDien  $giaDien
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGiaDientRequest $request)
    {
        $giadien = GiaDien::where('mabac', $request->__put)->first();
        if (
            $request->edit_mota == $giadien->tenbac &&
            $giadien->tusokw == $request->edit_star &&
            $giadien->densokw == $request->edit_end &&
            $giadien->dongia == $request->edit_dongia &&
            $giadien->ngayapdung == $request->date
        ) {
            $giadien->update_by = Auth::user()->name;
            $giadien->save();
            return back()->with('message', 'Bạn chưa thay đổi giá trị nào của đối tượng này !');
        } else {
            $giadien->tenbac = $request->edit_mota;
            $giadien->dongia = $request->edit_dongia;
            $giadien->tusokw = $request->edit_star;
            $giadien->densokw = $request->edit_end;
            $giadien->ngayapdung = $request->date;
            $giadien->update_by = Auth::user()->name;
            $giadien->save();
            return back()->with('message', 'Cập nhật thành công !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiaDien  $giaDien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GiaDien::destroy($id);
        return back()->with('message', 'Xóa thành công ');
    }
    public function showlist()
    {
        $data = GiaDien::all();
        return view('mycomponent.giadien_hientai', ['data' => $data]);
    }
}
