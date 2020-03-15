<?php

use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $titles = ['仕事', 'プライベート', '旅行', '勉強', '習い事', 'ライブ'];

        foreach ($titles as $title){
            DB::table('folders') -> insert([
                'title' => $title,
                'Created_at' => \Carbon\Carbon::now(),
                'Updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
