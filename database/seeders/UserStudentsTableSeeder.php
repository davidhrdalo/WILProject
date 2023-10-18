<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    # 1 - 5 Student assign id
    # software developer, project manager, business analyst, tester, client liaison 
    # Float up to 2 decimal
    public function run(): void
    {
        DB::table('user_students')->insert([
            'user_id' => 1,
            'gpa' => '5.23',
            'software_developer' => 1,
            'project_manager' => 2,
            'business_analyst' => 3,
            'tester' => 4,
            'client_liaison' => 5,
        ]);
        DB::table('user_students')->insert([
            'user_id' => 2,
            'gpa' => '5.60',
            'software_developer' => 2,
            'project_manager' => 3,
            'business_analyst' => 3,
            'tester' => 1,
            'client_liaison' => 4,
        ]);
        DB::table('user_students')->insert([
            'user_id' => 3,
            'gpa' => '4.01',
            'software_developer' => 4,
            'project_manager' => 4,
            'business_analyst' => 3,
            'tester' => 4,
            'client_liaison' => 4,
        ]);
        DB::table('user_students')->insert([
            'user_id' => 4,
            'gpa' => '6.23',
            'software_developer' => 1,
            'project_manager' => 1,
            'business_analyst' => 1,
            'tester' => 2,
            'client_liaison' => 1,
        ]);
        DB::table('user_students')->insert([
            'user_id' => 5,
            'gpa' => '3.88',
            'software_developer' => 1,
            'project_manager' => 5,
            'business_analyst' => 2,
            'tester' => 5,
            'client_liaison' => 5,
        ]);
    }
}
