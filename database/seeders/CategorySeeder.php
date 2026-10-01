<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::truncate();

        $categories = [
            [
                'id' => 1,
                'name' => 'Audio',
                'slug' => 'audio-gear',
                'title' => '🎧 Audio Gear & Sound',
                'icon_emoji' => '🎧',
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Gaming',
                'slug' => 'gaming-pc',
                'title' => '🎮 Gaming & PC Hardware',
                'icon_emoji' => '🎮',
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Furniture',
                'slug' => 'scandinavian-furniture',
                'title' => '🛋️ Luxury & Scandinavian Furniture',
                'icon_emoji' => '🛋️',
                'sort_order' => 3,
                'status' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Tech',
                'slug' => 'tech-wearables',
                'title' => '📱 Tech & Smart Wearables',
                'icon_emoji' => '📱',
                'sort_order' => 4,
                'status' => 1,
            ],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }
    }
}
