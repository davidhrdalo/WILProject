<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProjectImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_images')->insert([
            'project_id' => 1,
            'image' => 'project_images/data-center.jpeg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 1,
            'image' => 'project_images/firewall.jpg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 1,
            'image' => 'project_images/meeting.jpg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 2,
            'image' => 'project_images/data-center.jpeg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 3,
            'image' => 'project_images/firewall.jpg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 4,
            'image' => 'project_images/meeting.jpg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 5,
            'image' => 'project_images/data-center.jpeg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 5,
            'image' => 'project_images/firewall.jpg',
        ]);

        DB::table('project_images')->insert([
            'project_id' => 8,
            'image' => 'project_images/meeting.jpg',
        ]);
    }
}
