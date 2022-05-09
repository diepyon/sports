<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->updateOrInsert([
        //     'name' =>  substr(bin2hex(random_bytes(8)), 0, 8),
        //     '' =>'6',
        // ]);
    }
}
