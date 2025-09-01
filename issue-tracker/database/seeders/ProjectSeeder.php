<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{

    public function run()

    {
        
    $owner = User::first();

    
        Project::create([
            'name' => 'Mini Issue Tracker',
            'description' => 'A small app to manage projects and issues.',
            'start_date' => '2025-09-01',
            'deadline' => '2025-12-31',
            'owner_id' => $owner->id   
        ]);

        Project::create([
            'name' => 'E-Commerce Website',
            'description' => 'An online store with product management.',
            'start_date' => '2025-10-01',
            'deadline' => '2026-01-15',
            'owner_id' => $owner->id
        ]);

        Project::create([
            'name' => 'Bank System App',
            'description' => 'A MERN stack app for managing bank accounts and transactions.',
            'start_date' => '2025-08-01',
            'deadline' => '2025-11-30',
            'owner_id' => $owner->id
        ]);

        Project::create([
            'name' => 'Travel Itinerary Planner',
            'description' => 'An AI-powered travel planner with genetic algorithms.',
            'start_date' => '2025-09-15',
            'deadline' => '2026-02-28',
            'owner_id' => $owner->id
        ]);

        Project::create([
            'name' => 'Restaurant Management System',
            'description' => 'A Laravel + React system to handle orders and menus.',
            'start_date' => '2025-07-10',
            'deadline' => '2025-11-01',
            'owner_id' => $owner->id
        ]);
    }
}
