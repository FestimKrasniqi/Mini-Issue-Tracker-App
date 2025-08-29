<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;
use App\Models\Project;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $miniTracker = Project::where('name', 'Mini Issue Tracker')->first();
        $ecommerce = Project::where('name', 'E-Commerce Website')->first();
        $bankApp = Project::where('name', 'Bank System App')->first();
        $travelApp = Project::where('name', 'Travel Itinerary Planner')->first();
        $restaurantApp = Project::where('name', 'Restaurant Management System')->first();

        if (!$miniTracker || !$ecommerce || !$bankApp || !$travelApp || !$restaurantApp) {
            $this->command->warn('Some projects not found. Please run ProjectSeeder first.');
            return;
        }

        
        Issue::create([
            'title' => 'Homepage Layout Bug',
            'description' => 'Fix broken layout on homepage when viewed on mobile.',
            'status' => 'open',
            'priority' => 'high',
            'due_date' => '2025-09-15',
            'project_id' => $miniTracker->id,
        ]);

        Issue::create([
            'title' => 'Add Dark Mode',
            'description' => 'Implement dark mode support for the website.',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => '2025-10-01',
            'project_id' => $miniTracker->id,
        ]);

        Issue::create([
            'title' => 'Product Listing Error',
            'description' => 'Fix incorrect product prices showing in the catalog.',
            'status' => 'open',
            'priority' => 'high',
            'due_date' => '2025-10-15',
            'project_id' => $ecommerce->id,
        ]);

        Issue::create([
            'title' => 'Login Authentication Bug',
            'description' => 'Users cannot login in the Bank System app.',
            'status' => 'open',
            'priority' => 'high',
            'due_date' => '2025-08-20',
            'project_id' => $bankApp->id,
        ]);

        Issue::create([
            'title' => 'Generate Travel Plan Report',
            'description' => 'Reports are not generating correctly in Travel Itinerary Planner.',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => '2025-09-30',
            'project_id' => $travelApp->id,
        ]);

        Issue::create([
            'title' => 'Menu Update Bug',
            'description' => 'Unable to update menu items in Restaurant Management System.',
            'status' => 'open',
            'priority' => 'medium',
            'due_date' => '2025-07-25',
            'project_id' => $restaurantApp->id,
        ]);
    }
        
}
