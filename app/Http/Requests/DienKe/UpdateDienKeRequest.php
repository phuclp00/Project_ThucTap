<?php

namespace App\Http\Requests\DienKe;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDienKeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $todayDate = date('Y-m-d H:i:s');

        return [
            'makh' => 'required|regex:/^[a-zA-Z0-9\_]/',
            'ngaysx' => 'required|before_or_equal:' . $todayDate,
            'ngaylap' => 'required|after_or_equal:ngaysx|before_or_equal:' . $todayDate,
            'mota' => 'required|max:255|regex:/^[a-zA-Z0-9]/',
            'trangthai' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'ngaysx.required' => 'Ngày sản xuất phải nhỏ hơn hoặc bằng ngày hiện tại',
            'ngaylap.required' => 'Ngày lắp không được phép nhỏ hơn ngày sản xuất và ngày hiện tại',
            'mota.required' => "Mô tả phải khác mô tả ban đầu ",
        ];
    }
}
