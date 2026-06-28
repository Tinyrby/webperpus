<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 5; // Bahasa

$books = [
    [
        'title' => 'Bahasa Parwa I Tata Bahasa Jawa Kuna, Bentuk Kata',
        'author' => 'P.J.Zoetmulder; I.R.Poedjawijatna',
        'description' => null,
        'isbn' => '979-420-245-2',
        'call_number' => '499.222 ZOE b',
        'physical_desc' => '113 hlm, 20 cm',
        'stock' => 7
    ],
    [
        'title' => 'Tata Bahasa Bahasa Arab II',
        'author' => 'Muhammad, Abubakar',
        'description' => null,
        'isbn' => null,
        'call_number' => '492.5 MUH t',
        'physical_desc' => 'vii,317 hlm,20.5 cm',
        'stock' => 3
    ],
    [
        'title' => 'EYD (Ejaan yang Disempurnakan) Untuk Pelajar, Mahasiswa dan Umum',
        'author' => 'M.K. Abdullah, S.Pd',
        'description' => null,
        'isbn' => null,
        'call_number' => '411 ABD e',
        'physical_desc' => '93 h, ; 21 cm',
        'stock' => 1
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

echo "3 books successfully added to Category: 5 (Bahasa)\n";
