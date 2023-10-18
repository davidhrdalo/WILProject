<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /* User_id should be 7 - 17 */
    public function run(): void
    {
        DB::table('projects')->insert([
            'title' => 'Real-Time Traffic Analyzer',
            'user_id' => 7,
            'description' => 'Develop a tool that can analyze traffic and provide real-time reports on congestion, traffic incidents, and suggest alternative routes.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 3,
            'offering' => 1,
            'year' => 2024,
        ]);

        DB::table('projects')->insert([
            'title' => 'Health Monitoring App',
            'user_id' => 8,
            'description' => 'Create an application that monitors users health data, providing insights, alerts, and health-related suggestions based on the user\'s conditions.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 2,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Blockchain Cloud Storage',
            'user_id' => 9,
            'description' => 'Develop a secure, decentralized cloud storage system utilizing blockchain technology to ensure data integrity and security.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 5,
            'offering' => 1,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'AI E-Commerce Assistant',
            'user_id' => 10,
            'description' => 'Implement an AI-powered assistant for e-commerce platforms to help users in making purchasing decisions based on their preferences and purchase history.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 3,
            'offering' => 3,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Smart Home IoT Framework',
            'user_id' => 11,
            'description' => 'Design a framework to integrate various IoT devices for smart homes, allowing seamless control and monitoring of devices.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 1,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'VR Training Environment',
            'user_id' => 7,
            'description' => 'Develop a virtual reality environment designed for training individuals in various disciplines, providing an immersive learning experience.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 3,
            'offering' => 2,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'ML Sentiment Analysis Tool',
            'user_id' => 8,
            'description' => 'Create a machine learning tool that analyzes user reviews and feedback to determine the sentiment and provide insights to businesses.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 3,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Cyber Security Threat Detector',
            'user_id' => 9,
            'description' => 'Develop an advanced system that can identify and notify about various cybersecurity threats and potential vulnerabilities in real-time.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 2,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Augmented Reality Navigation App',
            'user_id' => 7,
            'description' => 'Create a mobile app using augmented reality to provide interactive navigation and location-based services.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 3,
            'offering' => 1,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Automatic Code Review Tool',
            'user_id' => 12,
            'description' => 'Develop a tool that can perform automated code reviews, suggesting improvements, finding bugs, and enforcing coding standards.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 5,
            'offering' => 3,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Sustainable Energy Management System',
            'user_id' => 13,
            'description' => 'Implement a comprehensive energy management system that optimizes energy consumption and promotes the use of sustainable energy sources.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 1,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'E-Learning Platform Enhancement',
            'user_id' => 14,
            'description' => 'Enhance an e-learning platform with new features, such as personalized learning paths, interactive content, and performance analytics.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 2,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Voice-Activated Virtual Assistant',
            'user_id' => 15,
            'description' => 'Develop a voice-activated virtual assistant that can understand and execute user commands accurately and learn from user interactions.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 3,
            'offering' => 1,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Fraud Detection with Machine Learning',
            'user_id' => 8,
            'description' => 'Create a machine-learning-based solution to detect and prevent fraudulent activities in real-time, with a focus on financial transactions.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 5,
            'offering' => 3,
            'year' => 2023,
        ]);
        
        DB::table('projects')->insert([
            'title' => 'Customizable E-commerce Platform',
            'user_id' => 10,
            'description' => 'Design an e-commerce platform allowing vendors to customize storefronts, manage inventory, and analyze sales data effectively.',
            'partner_name' => 'Steven Smith',
            'email' => 'partner@gmail.com',
            'team_size' => 4,
            'offering' => 1,
            'year' => 2023,
        ]);
        

    }
}

