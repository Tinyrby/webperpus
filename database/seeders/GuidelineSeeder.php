<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guideline;

class GuidelineSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['slug' => 'buku-panduan', 'title_id' => 'Buku Panduan Perpustakaan', 'title_en' => 'Library Guidebook', 'type' => 'pdf', 'order' => 1],
            ['slug' => 'referensi-ilmiah-apa7', 'title_id' => 'Panduan Referensi Karya Ilmiah (APA 7 Style)', 'title_en' => 'Scientific Reference Guide (APA 7 Style)', 'type' => 'pdf', 'order' => 2],
            ['slug' => 'penyusunan-proposal', 'title_id' => 'Panduan Penyusunan Proposal Skripsi', 'title_en' => 'Thesis Proposal Preparation Guide', 'type' => 'pdf', 'order' => 3],
            ['slug' => 'penelusuran-referensi', 'title_id' => 'Panduan Penelusuran Referensi', 'title_en' => 'Reference Search Guide', 'type' => 'pdf', 'order' => 4],
            ['slug' => 'guidebook-ung', 'title_id' => 'Library Guidebook of Universitas Negeri Gorontalo', 'title_en' => 'Library Guidebook of Universitas Negeri Gorontalo', 'type' => 'pdf', 'order' => 5],
            ['slug' => 'video-tutorial-sd', 'title_id' => 'Video Tutorial Panduan Penggunaan Science Direct', 'title_en' => 'Science Direct Usage Guide Video Tutorial', 'type' => 'video', 'order' => 6],
            ['slug' => 'panduan-sd-sivitas', 'title_id' => 'Panduan Penggunaan Science Direct bagi Sivitas Akademika Universitas Negeri Gorontalo', 'title_en' => 'Science Direct Usage Guide for Gorontalo State University Academics', 'type' => 'pdf', 'order' => 7]
        ];

        foreach($data as $d) { 
            Guideline::create($d); 
        }
    }
}
