<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return viod
     */
    public function run()
    {

        /* Students
        GPA: number between 0 to 7 
        software developer, project manager, business analyst, tester, client liaison. */

        DB::table('users')->insert([
            'name' => "Emma Johnson",
            'email' => 'student1@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
        ]);
        DB::table('users')->insert([
            'name' => "Liam Martinez",
            'email' => 'student2@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
        ]);
        DB::table('users')->insert([
            'name' => "Olivia Brown",
            'email' => 'student3@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
        ]);
        DB::table('users')->insert([
            'name' => "Alexander Robinson",
            'email' => 'student4@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
        ]);
        DB::table('users')->insert([
            'name' => "Isabella Garcia",
            'email' => 'student5@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
        ]);

        /** Teachers */
        DB::table('users')->insert([
            'name' => "Noah Davis",
            'email' => 'teacher1@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Teacher',
        ]);

        /** Partners */
        DB::table('users')->insert([
            'name' => "Lucas Thompson",
            'email' => 'partner1@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Sophia White",
            'email' => 'partner2@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Mason Lee",
            'email' => 'partner3@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Ava Harris",
            'email' => 'partner4@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Ethan Clark",
            'email' => 'partner5@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Mia Lewis",
            'email' => 'partner6@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Grace Jackson",
            'email' => 'partner7@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Henry Martin",
            'email' => 'partner8@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Jackson Baker",
            'email' => 'partner9@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Harper Gonzalez",
            'email' => 'partner10@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);
        DB::table('users')->insert([
            'name' => "Benjamin Hernandez",
            'email' => 'partner11@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Partner',
        ]);

        /** Student */
        DB::table('users')->insert([
            'name' => "Stephan Fern",
            'email' => 'student7@gmail.com',
            'password' => bcrypt('123456'),
            'type' => 'Student',
        ]);
    }
}
