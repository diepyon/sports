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
        DB::table('users')->insert([
            'name' =>  'があしい',
            'line_user_id' =>'U18ae2342ea3fa41e5c19677f7fawes22',
        ]); 
        DB::table('users')->insert([
            'name' =>  'しばたあ',
            'line_user_id' =>'U18ae2342ea3fa41e5chogehogessaswera',
        ]);    
        DB::table('users')->insert([
            'name' =>  'ぐぬえば',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]); 
        DB::table('users')->insert([
            'name' =>  'まこなる',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' => 'ぱええい',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' => 'あうえい',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>  'さかがみ',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>   'かかぽ',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>   'えふらん',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>  'はがせぶん',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>   'があどまん',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>   'ばあばぱぱ',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);
        DB::table('users')->insert([
            'name' =>  'ばきどう',
            'line_user_id' => substr(bin2hex(random_bytes(8)), 0, 8),
        ]);                            
    }
}
