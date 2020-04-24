<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{
    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));

        //'status' => 'required|in(1, 2, 3)'と同意
        return $rule + [
                'status' => 'required|' . $status_rule,
            ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        // CreateFolderのattributes()に以下を追加
        return $attributes + [
                'status' => '状態',
            ];
    }

    public function messages()
    {
        $messages = parent::messages();

        /*
         * エラー文字を作成
         * Task.phpで定義したconst STATUSの配列のすべての'label'キーを返す
        */
        $status_labels = array_map(function ($item) {
            return $item['label'];
        }, Task::STATUS);

        // 上記で取得したキーを'、'でつなげた文字列を代入
        $status_labels = implode('、', $status_labels);

        // エラーメッセージ作成
        return $messages + [
                'status.in' => ':attribute には ' . $status_labels . ' のいずれかを指定してください。',
            ];
    }
}
