<?php

use Illuminate\Database\Seeder;

class tasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 9; $i++) {
            DB::table('tasks')->insert([
            'title' => '期限設定なし' . $i,
            'importance' => 3,
            'urgency' => 1,
            'register' => 1,
            'teamId' => 9,
            'detail' => 'seeder3-1' . $i,
            ]);
        }
    }
}
