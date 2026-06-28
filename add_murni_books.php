<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 6; // Ilmu-ilmu Murni

$books = [
    [
        'title' => 'Tarsius Sulawesi : Kompilasi Riset dan Panduan Pemula Untuk Analisis Akuistik',
        'author' => 'Dr. Zullyanto Zakaria, M.Si',
        'description' => 'Buku ini menyajikan panduan lengkap untuk memahami tarsius, primata kesil endemik Sulawesi yang memikat perhatian ilmuwan dan pecinta alam. Alah satu fokus adalah vokalisasi tarsius, terutama duet ...',
        'isbn' => '978-623-147-701-9',
        'call_number' => '599.81 ZAK t',
        'physical_desc' => 'Cet.1,vi, 75 h, il ; 23 cm',
        'stock' => 2
    ],
    [
        'title' => 'Pengantar Statistika Untuk Penelitian',
        'author' => 'Dr. Riduwan, M.B.A; Dr. H. Sunarto, M.Si',
        'description' => null,
        'isbn' => '978-979-8433-43-6',
        'call_number' => '519.5 RID p',
        'physical_desc' => 'viii, 362 hlm, 24 cm',
        'stock' => 4
    ],
    [
        'title' => 'Mikrobiologi Umum Ed 6',
        'author' => 'Schlegel, Hans G',
        'description' => null,
        'isbn' => '979-420-321-1',
        'call_number' => '576 SCH m',
        'physical_desc' => 'xxi,688 hal,21 cm',
        'stock' => 8
    ]
];

foreach ($books as $b) {
    Book::create([
        'category_id' => $category_id,
        'title' => $b['title'],
        'author' => $b['author'],
        'description' => $b['description'],
        'isbn' => $b['isbn'],
        'call_number' => $b['call_number'],
        'physical_desc' => $b['physical_desc'],
        'stock' => $b['stock'],
        'slug' => Str::slug($b['title'] . '-' . Str::random(5)),
        'publisher' => null,
        'publish_year' => null,
        'language' => 'Indonesia',
        'cover_image' => null
    ]);
}

echo "3 books successfully added to Category: 6 (Ilmu-ilmu Murni)\n";
