<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    public function tasks(){
        /*
         * $this->hasMany('App\Task', 'folder_id', 'id');
        第二引数が テーブル名単数形_id で第三引数が id である時以下の様に省略可能。
        */
        return $this->hasMany('App\Task');
    }
}
