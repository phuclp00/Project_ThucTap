@isset($edit_item)
@foreach ($edit_item as $item)
<form action="{{url('/giadiens')}}/{{$item->mabac}}" method="post" style="margin: 20px">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="__put" value="{{$item->mabac}}">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="form-outline ">
        <label class="form-label" for="edit_mabac">Mã bậc</label>
        <input type="text" id="edit_mabac" name="edit_mabac" class="form-control" value="{{$item->mabac}}" disabled />
    </div>
    <div class="form-outline ">
        <label class="form-label" for="edit_mota">Mô tả</label>
        <input type="text" id="edit_mota" name="edit_mota" class="form-control" value="{{$item->tenbac}}" />
    </div>
    {{-- Tu so   --}}
    <div class="form-outline ">
        <label class="form-label" for="edit_star">Bắt đầu từ </label>
        <input type="text" id="edit_star" name="edit_star" class="form-control" value="{{$item->tusokw}}" />
    </div>
    {{--  Den so --}}
    <div class="form-outline ">
        <label class="form-label" for="edit_end">Đến</label>
        <input type="text" id="edit_end" name="edit_end" class="form-control" value="{{$item->densokw}}" />
    </div>
    <!-- Text input -->
    <div class="form-outline ">
        <label class="form-label" for="edit_dongia">Đơn giá</label>
        <input type="text" id="edit_dongia" name="edit_dongia" class="form-control" value="{{$item->dongia}}" />
    </div>

    <!-- Text input -->
    <div class="form-outline">
        <label class="form-label" for="date">Ngày áp dụng</label>
        <input type="text" name="date" class="form-control datepicker" value="{{$item->ngayapdung}}" />
    </div>
    <div class="form-outline" style="margin-top: 20px">
        <button type="submit" class="btn btn-primary">Save changes</button>
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