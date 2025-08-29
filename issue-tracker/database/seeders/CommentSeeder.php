<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Issue;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $issues = Issue::all();

        if ($issues->isEmpty()) {
            $this->command->warn('No issues found. Please run IssueSeeder first.');
            return;
        }

        foreach($issues as $issue) {
            Comment::create([
                'author_name' => 'Alice',
                'body' => 'Please fix this issue ASAP.',
                'issue_id' => $issue->id
            ]);

            Comment::create([
                'author_name' => 'Bob',
                'body' => 'I am working on this right now.',
                'issue_id' => $issue->id
            ]);
        }


    }
}
