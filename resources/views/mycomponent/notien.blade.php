<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách nợ tiền') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-6/7" style="margin: 20px auto;padding:20px">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Mã điện kế</th>
                                <th>Mã hóa đơn</th>
                                <th>Kỳ</th>
                                <th>Tổng tiền(VND)</th>
                                <th>Tình trạng</th>
                                <th>Lựa chọn</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach($kh_notien as $no )
                            <tr>
                                <td>{{$no->tenkh}}</td>
                                <td>{{$no->madk}}</td>
                                <td>{{$no->mahd}}</td>
                                <td>{{$no->ky}}</td>
                                <td>{{$no->tongthanhtien}}</td>
                                <td>@if($no->tinhtrang==0)
                                    Đã thanh toán
                                @else
                                    Chưa thanh toán
                                @endif
                                </td>
                                <td><a href="{{route('updatett', $no->mahd)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"> Cập nhật</i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>