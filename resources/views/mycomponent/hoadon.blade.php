<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách hóa đơn') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-7 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-6/7" style="margin: 20px auto;padding:20px">
                    <div class="col">
                        <div >
                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Tính tiền điện</button>
                            <div id="demo" class="collapse">
                                {{-- <div class="row"> --}}
                                    <div class="col-sm-5">
                                        {{-- Form tính tiền điện --}}
                                        <div class="card">
                                            <form action="" method="post" class="p-3">
                                                @csrf
                                                <div class="input-group col-md-20" style="margin-top: 20px">
                                                    <select class="custom-select" id="madk" name="madk">
                                                        @foreach($all_kh as $dk)
                                                        @if ($dk == reset($dk))
                                                        <option value="{{$dk->madk}}" selected>{{$dk->madk}}</option>
                                                        @else
                                                        <option value="{{$dk->madk}}">{{$dk->madk}}</option>
                                                        @endif 
                                                        @endforeach    
                                                    </select>
                                                    <div class="input-group-append">
                                                        <label class="input-group-text" for="madk">Danh sách ĐK</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="chisocuoi">Chỉ số hiện tại</label>
                                                    <input id="chisocuoi" class="form-control" type="text" name="chisocuoi">
                                                </div> 
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Form hóa đơn --}}
                                    {{-- <div class="col-sm-7">
                                        <div class="card">       
                                            <form class="p-5" action="" method="post">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Mã khách hàng:</label>
                                                    <div class="row-sm-10">
                                                    <td class="form-control-plaintext">PE001</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Tên khách hàng:</label>
                                                    <div class="row-sm-10">
                                                    <td>Kiều</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Địa chỉ:</label>
                                                    <div class="row-sm-10">
                                                    <td>2549 Phạm Thế Hiển</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Kỳ:</label>
                                                    <div class="row-sm-10">
                                                    <td>Tháng 4/2021</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Từ ngày:</label>
                                                    <div class="row-sm-10">
                                                    <td>18/03/2021</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Đến ngày:</label>
                                                    <div class="row-sm-10">
                                                    <td>18/04/2021</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Chỉ số đầu:</label>
                                                    <div class="row-sm-10">
                                                    <td>0</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Chỉ số cuối:</label>
                                                    <div class="row-sm-10">
                                                    <td>120</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Tổng thành tiền:</label>
                                                    <div class="row-sm-10">
                                                    <td>360.000</td>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label">Ngày lập hóa đơn:</label>
                                                    <div class="row-sm-10">
                                                    <td>18/04/2021</td>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <a class="btn btn-primary me-2" target="_blank" href="">In đơn hàng</a>
                                    </div> --}}
                                {{-- </div> --}}
                            </div>     
                        </div>

                    </div>
                    <hr>
                    {{-- Danh sách hóa đơn --}}
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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
                                <th>Tình trạng</th>
                                <th>Lựa chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hoadon as $hd )
                            
                            <tr>
                                <td>{{$hd->mahd}}</td>
                                <td>{{$hd->madk}}</td>
                                <td>{{$hd->makh}}</td>
                                <td>{{$hd->tenkh}}</td>
                                <td>{{$hd->diachi}}</td>
                                <td>{{$hd->ky}}</td>
                                <td>{{$hd->tungay}}</td>
                                <td>{{$hd->denngay}}</td>
                                <td>{{$hd->chisodau}}</td>
                                <td>{{$hd->chisocuoi}}</td>
                                <td>{{$hd->tongthanhtien}}</td>
                                <td>{{$hd->ngaylaphd}}</td>
                                <td>@if($hd->tinhtrang==0)
                                        Đã thanh toán
                                    @else
                                        Chưa thanh toán
                                    @endif
                                </td> 
                                <td>
                                    <a href="{{route('print_hoadon',$hd->mahd)}}" class="btn btn-primary"><i class="fas fa-pencil-alt">In hóa đơn</i></a>
                                </td>  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>