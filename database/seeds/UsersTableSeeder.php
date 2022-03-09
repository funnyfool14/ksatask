<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2; $i <= 10; $i++) {
            DB::table('users')->insert([
            'firstName' => 'テスト',
            'lastName' => $i,
            'email' => 'test'. $i . '@test',
            'password' => bcrypt('qqqqqqqq')
            ]);
        }
    }
}
