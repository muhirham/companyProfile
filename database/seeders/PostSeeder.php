<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus dulu data lama (opsional)
        Post::truncate();

        // Data dummy
        $posts = [
            [
                'title'   => 'Perawatan Genset Rutin untuk Menjaga Performa Maksimal',
                'excerpt' => 'Tips singkat bagaimana merawat genset agar tetap awet dan siap digunakan kapan saja.',
                'body'    => "Perawatan genset secara berkala sangat penting untuk memastikan mesin tetap bekerja optimal.\n\nBeberapa langkah perawatan meliputi pengecekan oli, filter udara, sistem bahan bakar, dan pengujian beban.",
                'status'  => 'published',
            ],
            [
                'title'   => 'Mengapa Perusahaan Membutuhkan Genset Cadangan?',
                'excerpt' => 'Penjelasan singkat mengenai pentingnya genset sebagai sumber listrik cadangan di perusahaan.',
                'body'    => "Gangguan listrik dapat menghambat operasional perusahaan, terutama pada sektor industri dan layanan kritikal.\n\nDengan adanya genset cadangan, operasional dapat tetap berjalan meskipun suplai listrik utama terputus.",
                'status'  => 'published',
            ],
            [
                'title'   => 'Memilih Kapasitas Genset yang Tepat untuk Bisnis Anda',
                'excerpt' => 'Cara menentukan kapasitas genset sesuai kebutuhan daya di perusahaan atau tempat usaha.',
                'body'    => "Penentuan kapasitas genset dimulai dari perhitungan total beban yang akan digunakan.\n\nPastikan kapasitas genset sedikit lebih besar dari kebutuhan daya untuk mengantisipasi lonjakan beban.",
                'status'  => 'draft',
            ],
        ];

        foreach ($posts as $data) {
            Post::create([
                'title'      => $data['title'],
                'slug'       => Str::slug($data['title']),
                'excerpt'    => $data['excerpt'],
                'body'       => $data['body'],
                'status'     => $data['status'],
                'image_path' => null, // nanti bisa diupdate lewat admin
            ]);
        }
    }
}
