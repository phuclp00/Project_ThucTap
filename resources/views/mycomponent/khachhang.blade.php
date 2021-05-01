<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách khách hàng') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-7 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-6/7" style="margin: 20px auto;padding:20px">
                    <div class="col-sm-5">
                        <h2>Thêm khách hàng</h2>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert text-danger">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <form action="{{route('store')}}" method="post" class="p-2">
                            @csrf
                            <div class="form-group">
                                <label for="makh">Mã khách hàng</label>
                                <input id="makh" class="form-control" type="text" name="makh" >
                            </div>
                            <div class="form-group">
                                <label for="tenkh">Tên khách hàng</label>
                                <input id="tenkh" class="form-control" type="text" name="tenkh" >
                            </div>
                            <div class="form-group">
                                <label for="sdt">Số điện thoại</label>
                                <input id="sdt" class="form-control" type="tel" name="sdt">
                            </div>
                            <div class="form-group">
                                <label for="cmnd">Chứng minh nhân dân</label>
                                <input id="cmnd" class="form-control" type="tel" name="cmnd">
                            </div>
                            <div class="form-group">
                                <label for="diachi">Địa chỉ</label>
                                <input id="diachi" class="form-control" type="text" name="diachi">
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm khách hàng</button>
                        </form>
                    </div>
                    <hr>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã khách hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>CMND</th>
                                <th>Ngày tạo</th>
                                <th>Người tạo</th>
                                <th>Ngày sửa</th>
                                <th>Người sửa</th>
                                <th>Lựa chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($khachhang as $kh )
                                <tr>
                                    <td>{{$kh->makh}}</td>
                                    <td>{{$kh->tenkh}}</td>
                                    <td>{{$kh->diachi}}</td>
                                    <td>{{$kh->dt}}</td>
                                    <td>{{$kh->cmnd}}</td>
                                    <td>{{$kh->create_at}}</td>
                                    <td>{{$kh->create_by}}</td>
                                    <td>{{$kh->update_at}}</td>
                                    <td>{{$kh->update_by}}</td>
                                    <td>
                                        <a href="{{route('update', $kh->makh)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"> Sửa</i></a>
                                        <a href="{{url('khachhang/delete/'.$kh->makh)}}" class="btn btn-danger"><i class="fas fa-trash-alt"> Xóa</i></a>
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
