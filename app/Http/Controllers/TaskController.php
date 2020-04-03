<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function showCreateForm(int $id)
    {
        return view('tasks.create', [
            'folder_id' => $id
        ]);
    }

    public function index(int $id)
    {
        $folders = Folder::all();

        $current_folder = Folder::find($id);

        $tasks = $current_folder->tasks()->get();

        return view('tasks.index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks
        ]);
    }
}
