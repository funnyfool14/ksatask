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
        for($i = 1; $i <= 2; $i++) {
            DB::table('users')->insert([
            'firstName' => 'test' . $i,
            'lastName' => 'test' . $i,
            'email' => 'test@test1' . $i,
            'password' => bcrypt('qqqqqqqq')
            ]);
        }
    }
}
