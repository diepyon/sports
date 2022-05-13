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
        DB::table('users')->updateOrInsert([
            'name' =>  'があしい',
            'line_user_id' =>'U18ae2342ea3fa41e5c19677f7fawes22',
        ]);        
    }
}
