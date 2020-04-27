<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folders', function (Blueprint $table) {
            /*
             * user_idカラムの追加
             * unsigned();は符号なし整数を指定するカラム修飾子(Mysqlのみ可)
             */
            $table->bigInteger('user_id')->unsigned();

            // 外部キー　実際に存在するuser_idの値しか入れることができないようにする
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            // user_idカラムの削除
            $table->dropColumn('user_id');
        });
    }
}
