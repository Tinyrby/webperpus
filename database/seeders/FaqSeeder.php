<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => 'Bagaimana cara membuat kartu perpustakaan?',
            'answer' => 'Saat ini untuk membuat kartu perpustakaan dapat menghubungi Operator kami setiap hari kerja.'
        ]);

        Faq::create([
            'question' => 'Apa persyaratan membuat surat bebas perpustakaan?',
            'answer' => 'Persyaratan membuat surat bebas perpustakaan adalah menyerahkan Kartu Tanda Mahasiswa (KTM), bukti pengembalian seluruh buku yang dipinjam, dan memastikan tidak ada denda aktif atau pinjaman buku yang tersisa.'
        ]);

        Faq::create([
            'question' => 'Cara mengupload Skripsi/Tesis/Disertasi melalui Aplikasi E-Skripsi',
            'answer' => 'Silakan login ke aplikasi E-Skripsi menggunakan akun Mahasiswa aktif Anda, kemudian isi formulir pengajuan unggah karya ilmiah, unggah dokumen PDF tugas akhir secara lengkap (termasuk lembar pengesahan bertandatangan), dan tunggu proses verifikasi oleh petugas perpustakaan.'
        ]);
    }
}
