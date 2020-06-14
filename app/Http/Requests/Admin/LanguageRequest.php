<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        return [
            'name'=>'required|string|max:100',
            'abbr'=>'required|string|max:10',
            // 'active'=>'required|in:0,1',
            'direction'=>'required|in:rtl,ltr',
        ];
    }

    public function messages()
    {
        return [
            'required'=>'هذا الحقل مطلوب' ,
            'in'=>'القيم المدلخه غير صحيحه',
            'name.string' => 'اسم الغه لابد ان يكون حرف',
            'name.max' => 'اسم الغه لابد  الا يزيد عن 100 احرف',
            'abbr.string' => 'اختصار الغه لابد ان يكون حرف',
            'abbr.max' => 'اختصار الغه لابد  الا يزيد عم 10 احرف',
           
        ];
    }
}
