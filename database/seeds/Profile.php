<?php

use Illuminate\Database\Seeder;

class Profile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2; $i <= 14; $i++) {
            DB::table('profiles')->insert([
            'userId' =>  $i,
            'companyId' => 1,
            'post' => 1,
            ]);
        }
    }
}
