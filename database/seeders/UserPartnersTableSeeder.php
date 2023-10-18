<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserPartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    # 7 - 17 assign partners
    public function run(): void
    {
        DB::table('user_partners')->insert([
            'user_id' => 7,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 8,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 9,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 10,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 11,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 12,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 13,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 14,
            'approved' => 'yes',
        ]);
        DB::table('user_partners')->insert([
            'user_id' => 15,
            'approved' => 'yes',
        ]);
    }
}
