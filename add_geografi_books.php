<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 10; // Geografi dan Sejarah

$books = [
    [
        'title' => '80 Tahun Prof. Dr. K.H. Ma\'ruf Amin : Kiai Wapres Wapres Kiai',
        'author' => 'Ahmad Baso',
        'description' => 'Dalam buku ini akan ditemukan bagaimana duet Jokowi Kiai Ma\'ruf bekerja dlam menjalankan mandat rakyat, sekaligus terlihat ada aspek pendekatan dalam kepemimpinan dalam menangani persoalan kebang...',
        'isbn' => null,
        'call_number' => null,
        'physical_desc' => null,
        'stock' => 3
    ],
    [
        'title' => 'The Renaissance : With New Introduction',
        'author' => 'Walter Pater',
        'description' => null,
        'isbn' => null,
        'call_number' => '940.2 PAT r',
        'physical_desc' => 'xii, 156 h, 18 cm',
        'stock' => 2
    ],
    [
        'title' => 'The Island Civilization Of Polynesia',
        'author' => 'Robert Suggs',
        'description' => null,
        'isbn' => null,
        'call_number' => '996 SUG i',
        'physical_desc' => '251 h, il ; 18 cm',
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

echo "3 books successfully added to Category: 10 (Geografi dan Sejarah)\n";
