<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create(); # Use factory to randomly create accounts

        $this->call(UsersTableSeeder::class);
        $this->call(UserPartnersTableSeeder::class);
        $this->call(UserStudentsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ProjectImagesTableSeeder::class);
        $this->call(ProjectFilesTableSeeder::class);
        $this->call(ApplicationsTableSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
