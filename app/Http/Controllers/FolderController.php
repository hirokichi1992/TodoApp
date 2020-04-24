<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolder;
use Illuminate\Http\Request;
use App\Folder;

use Illuminate\Support\Facades\Redirect;

class FolderController extends Controller
{
    //
    public function showCreateForm()
    {
        return view('folders/create');
    }

    /*
     * フォルダー作成
     * CreateFolderクラスのインスタンス$requestとしてうける
     * CreateFolderクラス：\App\Http\Requests\CreateFolder -> バリデーションを通したクラス
    */
    public function create(CreateFolder $request)
    {
        // インスタンス作成
        $folder = new Folder;

        // title属性にフォームからの値を代入
        $folder->title = $request->title;

        // 保存
        $folder->save();

        // リダイレクト
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
