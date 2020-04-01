<?php

namespace App\Http\Controllers;

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

    public function create(Request $request)
    {
        $folder = new Folder;
        $folder->title = $request->title;
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
