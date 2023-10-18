<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProjectFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_files')->insert([
            'project_id' => 1,
            'file' => 'project_files/Company-Description.pdf',
        ]);

        DB::table('project_files')->insert([
            'project_id' => 1,
            'file' => 'project_files/WIL-Project.pdf',
        ]);

        DB::table('project_files')->insert([
            'project_id' => 2,
            'file' => 'project_files/Company-Description.pdf',
        ]);

        DB::table('project_files')->insert([
            'project_id' => 3,
            'file' => 'project_files/WIL-Project.pdf',
        ]);

        DB::table('project_files')->insert([
            'project_id' => 4,
            'file' => 'project_files/Company-Description.pdf',
        ]);

        DB::table('project_files')->insert([
            'project_id' => 5,
            'file' => 'project_files/WIL-Project.pdf',
        ]);

    }
}
