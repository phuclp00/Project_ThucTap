<?php

namespace App\Http\Requests\GiaDien;

use Illuminate\Foundation\Http\FormRequest;

class StoreGiaDientRequest extends FormRequest
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
            'mabac' => 'required|unique:App\Models\GiaDien,mabac|numeric',
            'mota' => 'required|max:255|regex:/^[a-zA-Z]/',
            'dongia' => 'required|numeric|min:1',
            'date' => 'required|date|after_or_equal:' . $todayDate,
            'star' => 'required|numeric|min:1',
            'end' => 'nullable|numeric|gt:star'
        ];
    }
}
