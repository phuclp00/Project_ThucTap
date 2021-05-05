<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý giá điện hiện tại') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <x-nav-giadien />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome_giadien_hientai />
                @if ($errors->any())
                <div class="alert alert-danger border border-indigo-600 w-3/4" style="margin: 20px">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample" style="margin: 20px">
                    Thêm
                </button>
                {{-- Thêm table --}}
                <div class="collapse" id="collapseExample">
                    <div class="border border-indigo-600 w-3/4" style="margin: 20px">
                        <p class="h1" style="margin: 20px"> Thêm giá điện</p>
                        <form action="{{url("/giadiens")}}" method="POST" style="margin: 20px">
                            @csrf
                            <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="form-outline col-md-5">
                                <label class="form-label" for="mabac">Mã bậc</label>
                                <input type="text" id="mabac" name="mabac" class="form-control"
                                    value="{{ old('mabac') }}" />
                            </div>
                            <div class="form-outline col-md-8">
                                <label class="form-label" for="mota">Mô tả</label>
                                <input type="text" id="mota" name="mota" class="form-control"
                                    value="{{ old('mota') }}" />
                            </div>
                            {{-- Tu so   --}}
                            <div class="form-outline col-md-5">
                                <label class="form-label" for="star">Bắt đầu từ </label>
                                <input type="text" id="star" name="star" class="form-control"
                                    value="{{ old('star')}}" />
                            </div>
                            {{--  Den so --}}
                            <div class="form-outline col-md-5">
                                <label class="form-label" for="end">Đến</label>
                                <input type="text" id="end" name="end" class="form-control" value="{{ old('end')}}" />
                            </div>
                            <!-- Text input -->
                            <div class="form-outline col-md-5">
                                <label class="form-label" for="dongia">Đơn giá</label>
                                <input type="text" id="dongia" name="dongia" class="form-control"
                                    value="{{ old('dongia')}}" />
                            </div>

                            <!-- Text input -->
                            <div class="form-outline col-md-5">
                                <label class="form-label" for="date">Ngày áp dụng</label>
                                <input type="text" name="date" class="form-control datepicker"
                                    value="{{ old('date')}}" />
                            </div>
                            <!-- Submit button -->
                            <div class="form-outline col-md-5" style="margin-top: 20px">
                                <button type="submit" class="btn btn-primary ">OK</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="w-6/7" style="margin: 20px auto;padding:20px">
                    {{-- Data table --}}
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã bậc</th>
                                <th>Mô tả</th>
                                <th>Đơn giá</th>
                                <th>Chỉ số đầu</th>
                                <th>Chỉ số cuối</th>
                                <th>Ngày áp dụng</th>
                                <th>Ngày cập nhật</th>
                                <th>Người cập nhật</th>
                                <th>Lựa chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $data as $item)
                            <tr>
                                <td>{{$item->mabac}}</td>
                                <td>{{$item->tenbac}}</td>
                                <td>{{$item->dongia}}</td>
                                <td>{{$item->tusokw}}</td>
                                <td>{{$item->densokw}}</td>
                                <td>{{$item->ngayapdung}}</td>
                                @if($item->update_at ==null)
                                <td>{{$item->create_at}}</td>
                                @else
                                <td>{{$item->update_at}}</td>
                                @endif
                                @if($item->update_by ==null)
                                <td>{{$item->create_by}}</td>
                                @else
                                <td>{{$item->update_by}}</td>
                                @endif
                                <td>
                                    <div id="btn_group" class="btn-group" role="group" aria-label="Basic example">
                                        <button id="#btn_edit" type="button" class="btn btn-outline-warning"
                                            data-toggle="modal" data-target="#exampleModal" data-item="{{$item->mabac}}"
                                            onclick="show_edit(this)">Sửa</button>
                                        {{ Form::open(array('url' => 'giadiens/' . $item->mabac)) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Xóa', array('class' => 'btn btn-outline-danger')) }}
                                        {{ Form::close() }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Test --}}
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <x-giadien_popup />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
    </div>
    <script>
        function show_edit(params) {
            var id = params.getAttribute('data-item');
            $.get( "{{url('/giadiens')}}/" + id+"/edit", function( data ) {
                $(".modal-body").html(data);
            });
        }
    </script>
</x-app-layout>