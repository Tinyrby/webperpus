<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 2; // Filsafat

$books = [
    [
        'title' => 'NASIB DALAM SEMANGKUK BUBUK',
        'author' => 'RACHMAT RAMADHANA AL; BANJARI',
        'description' => null,
        'isbn' => '978-602-7869-33-2',
        'call_number' => '155.25',
        'physical_desc' => null,
        'stock' => 0
    ],
    [
        'title' => '10 Kesalahan Yang paling sering Dilakukan Orang Tua Dan Bagaimana Menghindari',
        'author' => 'Steede, Kevin',
        'description' => null,
        'isbn' => '979-9051-08-8',
        'call_number' => '155.4 STE s',
        'physical_desc' => 'xv, 169 hlm, 20 cm',
        'stock' => 4
    ],
    [
        'title' => 'Seni Konseling',
        'author' => 'May Rollo',
        'description' => 'Konseling sesungguhnya bukan salah satu penemuan baru dalam dunia modern.kita mengenal adanya istilah"percakapan terapeutis",yakni percakapan dalam situasi sehari-hari yang mana proses dan materi p...',
        'isbn' => '979-8581-69-5',
        'call_number' => '158.3 MAY s',
        'physical_desc' => 'xi,226 hlm,20 cm',
        'stock' => 4
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

echo "3 books successfully added to Category: 2 (Filsafat)\n";
