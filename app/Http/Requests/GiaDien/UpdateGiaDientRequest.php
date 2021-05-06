<?php

namespace App\Http\Requests\GiaDien;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UpdateGiaDientRequest extends FormRequest
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
            'edit_mota' => 'required|max:255|regex:/^[a-zA-Z0-9]/',
            'edit_dongia' => 'required|numeric|min:1',
            'date' => 'required|date|after_or_equal:' . $todayDate,
            'edit_star' => 'required|numeric|min:1',
            'edit_end' => 'nullable|numeric|gt:edit_star'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'mota.required' => 'Bạn cần phải nhập giá trị :attribute khác với giá trị ban đầu ',
    //         'dongia.required' => 'Bạn cần phải nhập giá trị :attribute khác với giá trị ban đầu',
    //         'date.required' => 'Bạn cần phải nhập giá trị :attribute khác với giá trị ban đầu',
    //         'star.required' => 'Bạn cần phải nhập giá trị :attribute khác với giá trị ban đầu',
    //         'end.required' => 'Bạn cần phải nhập giá trị :attribute khác với giá trị ban đầu',
    //     ];
    // }
}
