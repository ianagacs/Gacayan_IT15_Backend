<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'Campus Updates',
            'Study Tips',
            'Student Life',
            'Events',
        ];

        $categoryModels = collect($categories)->map(function (string $name) {
            return Category::create(['name' => $name]);
        });

        $posts = [
            [
                'title' => 'Welcome Week Essentials',
                'description' => 'A quick checklist for your first week on campus.',
                'category' => 'Campus Updates',
            ],
            [
                'title' => 'Library Guide',
                'description' => 'Find your favorite quiet spots and book resources.',
                'category' => 'Campus Updates',
            ],
            [
                'title' => 'Note-Taking Methods',
                'description' => 'Cornell, outline, and mind-map formats compared.',
                'category' => 'Study Tips',
            ],
            [
                'title' => 'Focus in 25 Minutes',
                'description' => 'Simple Pomodoro techniques for busy days.',
                'category' => 'Study Tips',
            ],
            [
                'title' => 'Cafeteria Favorites',
                'description' => 'Student picks for quick and healthy meals.',
                'category' => 'Student Life',
            ],
            [
                'title' => 'Clubs to Join',
                'description' => 'Meet new friends through activity-based clubs.',
                'category' => 'Student Life',
            ],
            [
                'title' => 'Tech Talk Friday',
                'description' => 'A short speaker session with an open Q&A.',
                'category' => 'Events',
            ],
            [
                'title' => 'Community Clean-Up',
                'description' => 'Volunteer day with snacks and a raffle.',
                'category' => 'Events',
            ],
        ];

        foreach ($posts as $post) {
            $category = $categoryModels->firstWhere('name', $post['category']);

            if ($category) {
                Post::create([
                    'category_id' => $category->id,
                    'title' => $post['title'],
                    'description' => $post['description'],
                ]);
            }
        }
    }
}
