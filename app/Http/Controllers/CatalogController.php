<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Query for search or base catalog
        $query = Book::with('category');
        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                  ->orWhere('author', 'like', "%{$keyword}%")
                  ->orWhereHas('category', function($q) use ($keyword) {
                      $q->where('name', 'like', "%{$keyword}%");
                  });
        }

        $searchResults = $keyword ? $query->paginate(12)->withQueryString() : null;

        if (!$keyword) {
            $popularBooks = Book::with('category')->withCount('loans')->orderBy('loans_count', 'desc')->take(6)->get();
            $newBooks = Book::with('category')->orderBy('created_at', 'desc')->take(6)->get();
            $topMembers = Member::withCount('loans')->orderBy('loans_count', 'desc')->take(4)->get();
            $categories = \App\Models\Category::all();
            
            return view('catalog.index', compact('keyword', 'searchResults', 'popularBooks', 'newBooks', 'topMembers', 'categories'));
        }

        return view('catalog.index', compact('keyword', 'searchResults'));
    }

    public function show(Book $book)
    {
        $book->load(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        return view('catalog.show', compact('book'));
    }

    public function information()
    {
        return view('catalog.information');
    }

    public function help()
    {
        return view('catalog.help');
    }

    public function guidelines($slug = null)
    {
        $guidelinesList = \App\Models\Guideline::where('is_active', true)
                                               ->orderBy('order', 'asc')
                                               ->get();

        if ($guidelinesList->isEmpty()) {
            abort(404, 'Panduan tidak ditemukan.');
        }

        if (!$slug) {
            $currentGuide = $guidelinesList->first();
            return redirect()->route('katalog.guidelines', $currentGuide->slug);
        }

        $currentGuide = $guidelinesList->where('slug', $slug)->first();

        if (!$currentGuide) {
            abort(404, 'Panduan tidak ditemukan.');
        }

        return view('catalog.guidelines', compact('slug', 'guidelinesList', 'currentGuide'));
    }

    public function faq($slug = null)
    {
        $faqList = [
            'buat-kartu' => [
                'question' => 'Bagaimana cara membuat kartu perpustakaan?',
                'answer' => 'Saat ini untuk membuat kartu perpustakaan dapat menghubungi Operator kami setiap hari kerja.'
            ],
            'syarat-bebas' => [
                'question' => 'Apa persyaratan membuat surat bebas perpustakaan?',
                'answer' => 'Membawa kartu mahasiswa serta membawa biaya untuk administrasi sejumlah Rp 35.000'
            ],
            'upload-skripsi' => [
                'question' => 'Cara mengupload Skripsi/Tesis/Disertasi melalui Aplikasi E-Skripsi',
                'answer' => '<p>E-Skripsi merupakan aplikasi yang dikembangkan oleh UPT Perpustakaan UNG dalam rangka digitalisasi koleksi perpustakaan dalam hal ini skripsi, tesis dan disertasi. Sebelumnya koleksi perpustakaan tersebut masih dikumpulkan dalam bentuk hardcopy sehingga membutuhkan ruang penyimpanan yang cukup besar dikarenakan koleksi skripsi, tesis dan disertasi yang terus bertambah setiap tahunnya. Melalui aplikasi e-Skripsi mahasiswa tidak lagi mengumpulkan skripsi, tesis, dan disertasi dalam bentuk hardcopy melainkan sudah dalam bentuk softcopy (digital) yang diunggah secara mandiri oleh mahasiswa.</p><br><p>Aplikasi ini juga akan secara otomatis menginput Surat Penyerahan Skripsi oleh mahasiswa yang sudah ditandatangani secara elektronik. Layanan eSkripsi dalam di akses melalui <a href="https://eskripsi.perpustakaan.ung.ac.id" target="_blank" style="color: #3b82f6; text-decoration: none;">https://eskripsi.perpustakaan.ung.ac.id</a>.</p><br><p>TATA CARA PENGINPUTAN E-SKRIPSI</p><br><ol style="margin-left: 1.5rem;"><li>Mahasiswa menginput link <a href="https://eskripsi.perpustakaan.ung.ac.id" target="_blank" style="color: #3b82f6; text-decoration: none;">https://eskripsi.perpustakaan.ung.ac.id</a>, kemudian klik Unggah Mandiri</li><li>Untuk masuk dalam akun e-Skripsi mahasiswa harus memasukkan username dan password, kemudian klik Masuk. Untuk username masukkan NIM. Untuk password masukkan kombinasi NIM dan tanggal lahir (NIM+YYYY+MM+DD). Contoh: Username: 413417039 Password: 41341703919990525</li><li>Setelah muncul gambar seperti yang ditampilkan selanjutnya klik Unggah Mandiri</li><li>Mahasiswa mengisi form skripsi yang ditampilkan. Pastikan semua data diisi dengan lengkap dan benar, klik Simpan untuk menyimpan draft skripsi anda, atau klik Simpan & Kirim untuk menyimpan sekaligus mengirim draft skripsi untuk selanjutnya diverifikasi oleh Administrator. Skripsi yang telah dikirim tidak dapat di edit kembali.</li><li>Setelah melakukan registrasi diharapkan mahasiswa untuk terus mengecek Status yang di tampilkan</li></ol>'
            ],
        ];

        if (!$slug || !array_key_exists($slug, $faqList)) {
            $slug = 'buat-kartu';
            return redirect()->route('katalog.faq', $slug);
        }

        $currentFaq = $faqList[$slug];

        return view('catalog.faq', compact('faqList', 'slug', 'currentFaq'));
    }

    public function facilities($slug = null)
    {
        $facilitiesList = \App\Models\Facility::all();

        if ($facilitiesList->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada fasilitas yang tersedia.');
        }

        if (!$slug) {
            $slug = $facilitiesList->first()->slug ?? $facilitiesList->first()->id;
            return redirect()->route('katalog.facilities', $slug);
        }

        $currentFacility = \App\Models\Facility::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();

        return view('catalog.facilities', compact('slug', 'facilitiesList', 'currentFacility'));
    }

    public function storeComment(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $book->comments()->create([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
