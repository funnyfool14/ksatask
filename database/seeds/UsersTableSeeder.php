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
        for($i = 1; $i <= 15; $i++) {
            DB::table('users')->insert([
            'firstName' => 'ใในใ',
            'lastName' => $i,
            'email' => 'test'. $i . '@test',
            'password' => bcrypt('qqqqqqqq')
            ]);
        }
    }
}
