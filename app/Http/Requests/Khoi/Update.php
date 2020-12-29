<?php

namespace App\Http\Requests\Khoi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Khoi;
class Update extends FormRequest
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
        $dataKhoi = Khoi::find($this->id);
        // dd(Khoi::where('nam_hoc_id', $dataKhoi->nam_hoc_id)->where('id', '!=',$this->id)->get()->toArray()[0]);
        return [
            'ten_khoi' =>  [
                'required',
                'between:5,30', 
                Rule::unique('khoi')
                       ->where('nam_hoc_id', $dataKhoi->nam_hoc_id)->where('id', '!=',$this->id)->ignore($this->id)
            ],
        ];
    }

    public function messages(){
        return [
            'ten_khoi.required' => 'Tên khối không được để trống',
            'ten_khoi.unique' => 'Tên khối đã tồn tại',
            'ten_khoi.between' => 'Tên khối phải có độ dài từ 5 đến 30 kí tự',
        ];
    }
}
