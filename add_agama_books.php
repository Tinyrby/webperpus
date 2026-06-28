<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 3; // Agama

$books = [
    [
        'title' => 'Pelajaran Bahas Arab, Untuk umum',
        'author' => 'Kafie, Jamaluddin',
        'description' => 'Bahasa arab adalah bahasa Al-Qur\'an yang harus kita imani dan pahami.Kitab Pedoman dan pegangan hidup yang tak lapuk dari hujan dantak lekang dari panas. Al-Quran harus kita gali dengan cara belaja...',
        'isbn' => null,
        'call_number' => '297 KAF p',
        'physical_desc' => 'ix, 97 hal,21 cm',
        'stock' => 3
    ],
    [
        'title' => 'Unjuk rasa kepada allah',
        'author' => 'Imron, Zawawi',
        'description' => 'buku ini memberikan inspirasi syair bahwa bentuk unjuk rasa kepada Allah bukan dalam arti menenantang perintah namun bagaimana meluruskan jalan hidup, cara hidup, hidup sesat dan cita rasa hidup de...',
        'isbn' => '979-514-827-3',
        'call_number' => '297 IMR u',
        'physical_desc' => 'xi, 260 h, 21 cm',
        'stock' => 5
    ],
    [
        'title' => 'Pedoman Pelaksanaan P4 Bagi Umat Islam',
        'author' => 'Pedoman',
        'description' => null,
        'isbn' => null,
        'call_number' => '298 PED p',
        'physical_desc' => '54 h ; 21 cm',
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

echo "3 books successfully added to Category: 3 (Agama)\n";
