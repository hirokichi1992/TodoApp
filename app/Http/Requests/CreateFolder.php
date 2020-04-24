<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
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
            // name属性"title"は入力必須で最大20文字
            'title' => 'required|max:20',
        ];
    }

    // エラー文字の日本語化
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
