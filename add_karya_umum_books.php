<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 1; // Karya Umum

$books = [
    [
        'title' => 'SPSS 13.0 Terapan; Riset Statistik Parametik',
        'author' => 'Triton Prawira Budi',
        'description' => null,
        'isbn' => '979-763-115-x',
        'call_number' => '001.422 TRI s',
        'physical_desc' => 'x,278 h ; 21cm',
        'stock' => 5
    ],
    [
        'title' => 'Pengadaan dan Pemilihan Bahan Pustaka',
        'author' => 'Soejono Trimo, MLS',
        'description' => null,
        'isbn' => null,
        'call_number' => '020.75 TRI p',
        'physical_desc' => '83 h,ilus,21 cm',
        'stock' => 7
    ],
    [
        'title' => 'Ipad : Portable Genius Third Edition',
        'author' => 'McFedries, Paul',
        'description' => null,
        'isbn' => '978-1-118-93214-8',
        'call_number' => '004.165 Mcf i',
        'physical_desc' => 'xviii, 319h, il , index : 23 cm',
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

echo "3 books successfully added to Category: 1 (Karya Umum)\n";
