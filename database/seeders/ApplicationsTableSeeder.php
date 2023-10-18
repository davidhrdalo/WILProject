<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 1 - 5 Student assign id
     */



    public function run(): void
    {
        // User 1
        DB::table('applications')->insert([
            'user_id' => 1,
            'project_id' => 1,
            'justification' => 'Having dealt with traffic analysis in the past, I believe my skills will be immensely beneficial for this project.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 1,
            'project_id' => 4,
            'justification' => 'The real-time nature of this project intrigues me. I believe I can bring a fresh perspective to it.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 1,
            'project_id' => 6,
            'justification' => 'Having dealt with similar challenges in my past projects, I am eager to contribute to this.',
        ]);

        // User 2
        DB::table('applications')->insert([
            'user_id' => 2,
            'project_id' => 2,
            'justification' => 'I have a solid background in this domain and am confident in my ability to deliver.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 2,
            'project_id' => 5,
            'justification' => 'This project aligns perfectly with my academic pursuits and interests.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 2,
            'project_id' => 8,
            'justification' => 'I have a fresh approach that I believe could redefine the outcome of this project.',
        ]);

        // User 3
        DB::table('applications')->insert([
            'user_id' => 3,
            'project_id' => 3,
            'justification' => 'The challenges this project poses are exactly what I am looking for in my next endeavor.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 3,
            'project_id' => 7,
            'justification' => 'Having successfully executed a similar project in the past, I am eager to bring my expertise here.',
        ]);

        // User 4
        DB::table('applications')->insert([
            'user_id' => 4,
            'project_id' => 9,
            'justification' => 'This project aligns perfectly with the skills I have been honing over the past year.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 4,
            'project_id' => 11,
            'justification' => 'I have a deep interest in this area and am eager to contribute my skills and learn more.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 4,
            'project_id' => 13,
            'justification' => 'With my background in this domain, I believe I can bring a unique perspective to the table.',
        ]);

        // User 5
        DB::table('applications')->insert([
            'user_id' => 5,
            'project_id' => 10,
            'justification' => 'The objectives of this project resonate with my personal interests in this domain.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 5,
            'project_id' => 12,
            'justification' => 'Having dealt with a similar challenge in a past project, I am eager to apply my learnings here.',
        ]);

        DB::table('applications')->insert([
            'user_id' => 5,
            'project_id' => 15,
            'justification' => 'I am confident in my ability to contribute significantly to this project, given my past experiences.',
        ]);

    }
}
