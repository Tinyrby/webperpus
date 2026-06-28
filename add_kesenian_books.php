<?php

use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;

$category_id = 8; // Kesenian, Hiburan, dan Olahraga

$books = [
    [
        'title' => 'Rancangan Visual Lansekap Jalan panduan Estetika Dinding Penghalang Kebisingan',
        'author' => 'Ir. Rustam Hakim M T',
        'description' => 'Salah satu masalah yang sering dihadapi desainer jalan adalah problematika kebisingan. Didalam merancang arsitektur lansekap, usaha untuk mengurangi kebisingan dapat dilakukan dengan menempatkan ...',
        'isbn' => '979-420-721-4',
        'call_number' => '720.47 HAK r',
        'physical_desc' => 'vii, 162 hlm; ilus, 21 cm',
        'stock' => 3
    ],
    [
        'title' => 'Memancing di perairan tawar dan di laut',
        'author' => 'murtidjo',
        'description' => 'Buku ini memberikan pemahaman bahwa pancing mempunyai fungsi buku yang luas popouler yaitu sebagai sarana peluasal kegemaran. Ada sesuatu yang salah, ...',
        'isbn' => '979-489-329-3',
        'call_number' => '799.1 MUR m',
        'physical_desc' => 'viii, 126 hlm; ilus., 21 cm',
        'stock' => 1
    ],
    [
        'title' => 'Pengantar Arsitektur',
        'author' => 'snyder c james',
        'description' => null,
        'isbn' => null,
        'call_number' => '720 SNY p',
        'physical_desc' => 'xi, 168 h; il ; 21 cm',
        'stock' => 2
    ],
    [
        'title' => 'Ngetren abis, bo!',
        'author' => 'rida harlinauli',
        'description' => 'Buku "ngetren abis,bo!" ini berusaha ngasih semangat kepada kamu-kamu agar menyongsong masa depan dengan lebih gagah, lebih berani dan lebih pasti.',
        'isbn' => null,
        'call_number' => '741.5 HAR n',
        'physical_desc' => '48 hlm; ilus, 17 cm',
        'stock' => 2
    ],
    [
        'title' => 'oh, A-Hunting we will go',
        'author' => 'langstaff john',
        'description' => null,
        'isbn' => '0-20-179831-4',
        'call_number' => '784 LAN p',
        'physical_desc' => '32 hlm ; ilus ; 25.5cm',
        'stock' => 1
    ],
    [
        'title' => 'Girls Who Rocked the Word',
        'author' => 'weldon amelia',
        'description' => 'Girls who rocked the world tells the incredible stories of thirty. These real girls past and present from all around the world who achieved amazing feats and changed history before reaching their ...',
        'isbn' => '0-439-10490-9',
        'call_number' => '784.54 WEL g',
        'physical_desc' => '116 hlm; ilus, 21 cm',
        'stock' => 1
    ],
    [
        'title' => 'Permainan rekreatif sebagai pengisi kegiatan wisata bahari siswa SLTA (buku p...',
        'author' => 'direktorat jendral pendidikan dasar dan menengah. departemen pendidikan dan kebudayaan',
        'description' => null,
        'isbn' => null,
        'call_number' => '790 Per p',
        'physical_desc' => 'ix, 52 hlm ; 20,5 cm',
        'stock' => 2
    ],
    [
        'title' => 'Jazz : The First 100 Years',
        'author' => 'henry martin; keith waters',
        'description' => null,
        'isbn' => '978-1-4390-8360-4',
        'call_number' => '781.65 MAR j',
        'physical_desc' => 'xxiii, 432 h; il ; 28 cm',
        'stock' => 1
    ],
    [
        'title' => 'Komik Edukatif Semangat Belajar',
        'author' => 'nurul f. r; sarah maryam dkkkm',
        'description' => null,
        'isbn' => null,
        'call_number' => '741.5 NUR k',
        'physical_desc' => '52 h; il ; 21 cm',
        'stock' => 1
    ],
    [
        'title' => 'Theatre',
        'author' => 'cohen, robert',
        'description' => null,
        'isbn' => '978-0-07-338218-0',
        'call_number' => '792 COH t',
        'physical_desc' => 'xvii,688 h; il; Lamp 28,5 cm',
        'stock' => 3
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

echo "10 books successfully added to Category: 8 (Kesenian, Hiburan, dan Olahraga)\n";
