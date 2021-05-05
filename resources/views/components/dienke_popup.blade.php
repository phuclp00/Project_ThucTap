@isset($edit_item)
@foreach ($edit_item as $item)
<form action="{{url('/dienkes')}}/{{$item->madk}}" method="post" style="margin: 20px">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="__put" value="{{$item->madk}}">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="form-outline">
        <label class="form-label" for="madk">Mã điện kế</label>
        <input type="text" id="madk" name="madk" class="form-control" value="{{$item->madk}}" disabled />
    </div>
    {{-- Tu so   --}}

    <div class="input-group" style="margin-top: 20px">
        <select class="custom-select" id="makh" name="makh">
            @foreach ($kh_list as $data)
            @if ($data->makh == $item->makh))
            <option value="{{$data->makh}}" selected>{{ $data->tenkh}}</option>
            @else
            <option value="{{$data->makh}}">{{ $data->tenkh}}</option>
            @endif
            @endforeach
        </select>
        <div class="input-group-append">
            <label class="input-group-text" for="makh">Danh sách khách
                hàng</label>
        </div>
    </div>
    <div class="form-outline ">
        <label class="form-label" for="mota">Mô tả</label>
        <input type="text" id="mota" name="mota" class="form-control" value="{{$item->mota}}" />
    </div>
    {{--  Trạng thái --}}
    <div class="input-group " style="margin-top: 20px">
        <select class="custom-select" id="trangthai" name="trangthai">
            @if ($item->trangthai == true)
            <option value="1" selected>Đang hoạt động</option>
            <option value="0">Ngưng hoạt động </option>
            @else
            <option value="1">Đang hoạt động</option>
            <option value="0" selected>Ngưng hoạt động </option>
            @endif
        </select>
        <div class="input-group-append">
            <label class="input-group-text" for="trangthai">trạng thái</label>
        </div>
    </div>

    <!-- Text input -->
    <div class="form-outline ">
        <label class="form-label" for="date">Ngày sản xuất </label>
        <input type="text" name="ngaysx" class="form-control datepicker" value="{{$item->ngaysx}}" />
    </div>
    <!-- Text input -->
    <div class="form-outline ">
        <label class="form-label" for="date_lap">Ngày lắp </label>
        <input id="datetimepicker2" type="text" name="ngaylap" class="form-control datepicker"
            value="{{ $item->ngaylap}}" />
    </div>
    <!-- Submit button -->
    <div class="form-outline " style="margin-top: 20px">
        <button type="submit" class="btn btn-primary ">Save changes</button>
    </div>
    <!-- Submit button -->
    <script>
        jQuery('.datepicker').datetimepicker({
           format:'Y-m-d H:i:s',
        });
    </script>
</form>
@endforeach
@endisset