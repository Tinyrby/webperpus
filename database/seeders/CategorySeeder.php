<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Karya Umum', 'icon' => '🖥️🌐'],
            ['name' => 'Filsafat', 'icon' => '🧠💭'],
            ['name' => 'Agama', 'icon' => '🕌⛪'],
            ['name' => 'Ilmu-ilmu Sosial', 'icon' => '📜🏅'],
            ['name' => 'Bahasa', 'icon' => '🗣️🌐'],
            ['name' => 'Ilmu-ilmu Murni', 'icon' => '📐🔬'],
            ['name' => 'Ilmu-ilmu Terapan', 'icon' => '💻📈'],
            ['name' => 'Kesenian, Hiburan, dan Olahraga', 'icon' => '🎨🎭'],
            ['name' => 'Kesusastraan', 'icon' => '🍎📚'],
            ['name' => 'Geografi dan Sejarah', 'icon' => '⏱️🌍'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
