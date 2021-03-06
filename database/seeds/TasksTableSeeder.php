<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 3) as $folder_id) {
            foreach (range(1, 3) as $num) {
                DB::table('tasks')->insert([
                    'folder_id' => $folder_id,
                    'title' => "サンプルタスク{$num}",
                    'status' => $num,
                    'due_date' => \Carbon\Carbon::now()->addDay($num),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
