<?php

namespace App\Http\Requests\DienUuTien;

use Illuminate\Foundation\Http\FormRequest;

class StoreDienUuTien extends FormRequest
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
        $data = $this->all();
        unset($data['_token']);
        return [
            'ten_chinh_sach' => 'required',
            'muc_mien_giam' => 'required|numeric|min:0|max:100'
        ];
    }
}