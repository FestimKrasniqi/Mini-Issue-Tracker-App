<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Issue;
use App\Models\Tag;

class IssueTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $issues = Issue::all();
        $tags = Tag::all();

        if($issues->isEmpty() || $tags->isEmpty()) {
            $this->command->warn('No issues or tags found. Please run IssueSeeder and TagSeeder first');
            
        }

        foreach($issues as $issue) {
            $randomTags = $tags->random(rand(1,3))->pluck('id')->toArray();
            $issue->tags()->attach($randomTags);
        }
        
    }
}
