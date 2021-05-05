<?php

namespace App\Http\Requests\DienKe;

use Illuminate\Foundation\Http\FormRequest;

class StoreDienKeRequest extends FormRequest
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
            'madk' => 'required|unique:App\Models\DienKe,madk|regex:/[0-9]{8}/',
            'makh' => 'required|max:255|regex:/^[a-zA-Z0-9\_]/',
            'ngaysx' => 'required|before_or_equal:' . $todayDate,
            'ngaylap' => 'required|after_or_equal:ngaysx|before_or_equal:' . $todayDate,
            'mota' => 'required|max:255|regex:/^[a-zA-Z0-9]/',
            'trangthai' => 'required'
        ];
    }
}
