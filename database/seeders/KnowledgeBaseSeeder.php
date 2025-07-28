<?php

namespace Database\Seeders;

use App\Models\KnowledgeBase;
use Illuminate\Database\Seeder;

class KnowledgeBaseSeeder extends Seeder
{
    public function run()
    {
        $knowledgeData = [
            [
                'title' => 'Cara Login ke Sistem',
                'content' => 'Untuk login ke sistem praktikum, silakan masukkan NIM dan password yang telah diberikan oleh asisten. Jika lupa password, hubungi asisten praktikum.',
                'category' => 'Login',
                'keywords' => 'login, password, NIM, masuk, sistem',
            ],
            [
                'title' => 'Jadwal Praktikum',
                'content' => 'Praktikum dilaksanakan setiap hari Selasa dan Kamis pukul 13.00-15.00 WIB di Lab Komputer lantai 2.',
                'category' => 'Jadwal',
                'keywords' => 'jadwal, waktu, lab, praktikum, selasa, kamis',
            ],
            [
                'title' => 'Syarat Mengikuti Praktikum',
                'content' => 'Mahasiswa wajib hadir tepat waktu, membawa laptop, dan telah mengerjakan pre-test sebelum praktikum dimulai.',
                'category' => 'Syarat',
                'keywords' => 'syarat, aturan, laptop, pretest, hadir',
            ],
            [
                'title' => 'Tata Tertib Lab',
                'content' => 'Dilarang makan dan minum di lab, menjaga kebersihan, tidak membuat keributan, dan menggunakan komputer sesuai keperluan praktikum.',
                'category' => 'Aturan',
                'keywords' => 'tata tertib, aturan, lab, kebersihan, komputer',
            ],
        ];

        foreach ($knowledgeData as $data) {
            KnowledgeBase::create($data);
        }
    }
}