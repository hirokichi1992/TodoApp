<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('folder_id')->unsigned();
            $table->string('title', 100);
            $table->date('due_date');
            // デフォルトは未着手なので"1"に設定
            $table->integer('status')->default(1);
            $table->timestamps();

            // 外部キー　実際に存在するfolder_idの値しか入れることができないようにする
            $table->foreign('folder_id')->references('id')->on('folders');
        });
    }

    /**
 * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
