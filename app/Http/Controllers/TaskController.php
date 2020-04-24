<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * GET /folders/{id}/tasks/create
     */
    public function showCreateForm(int $id)
    {
        return view('tasks.create', [
            'folder_id' => $id
        ]);
    }

    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(int $id, int $task_id)
    {
        // 編集画面に遷移した時には選択したタスク情報が記入されている状態にしておく
        $task = Task::find($task_id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function index(int $id)
    {
        // フォルダーを全て取得
        $folders = Folder::all();

        // 現在のフォルダーを取得
        $current_folder = Folder::find($id);

        /*
         * 現在のフォルダーのタスクを全て取得
         * $tasks = Task::where('folder_id', $current_folder->id)->get();
         * 下記は上の省略系
        */
        $tasks = $current_folder->tasks()->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }

    /*
     * タスク作成
     * CreateTaskクラスのインスタンス$requestとしてうける
     * CreateTaskクラス：\App\Http\Requests\CreateTask -> バリデーションを通したクラス
    */
    public function create(int $id, CreateTask $request)
    {
        // 現在のフォルダーを取得
        $current_folder = Folder::find($id);

        // タスクのインスタンス化
        $task = new Task();

        // フォームからバリデーションを通したrequestインスタンスの要素値を代入
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // 現在のフォルダーのタスクを保存
        $current_folder->tasks()->save($task);

        // リダイレクト
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        // 現在のタスクを取得
        $task = Task::find($task_id);

        // requestインスタンスの要素値を代入・保存
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // リダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);

    }
}
