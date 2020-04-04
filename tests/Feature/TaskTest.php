<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Http\Requests\CreateTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    // 各テストメソッドの実行前に呼ばれる
    public function setUp(): void
    {
        parent::setUp();

        //テストケース実行前にフォルダーデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /**
     * 期限日が日付でない場合はバリデーションエラー
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample Task',
            'due_date' => 7464527, // 不正なデータ（数字）
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日には日付を入力してください',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample Task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), // 不正なフォーマット（昨日の日付）
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日には今日以降の日付を入力してください',
        ]);
    }

}
