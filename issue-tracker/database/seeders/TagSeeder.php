<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'bug','color' => '#ff0000'],
            ['name' => 'Feature', 'color' => '#00ff00'],
            ['name' => 'Urgent', 'color' => '#0000ff'],
            ['name' => 'Low Priority', 'color' => '#ff00ff'],
            ['name' => 'Backend', 'color' => '#00ffff'],
            ['name' => 'Frontend', 'color' => '#ffff00'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
        
    }
}
