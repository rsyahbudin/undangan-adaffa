<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wedding;
use App\Models\Couple;
use App\Models\Schedule;
use App\Models\Media;
use App\Models\Guest;
use Carbon\Carbon;

class WeddingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample wedding
        $wedding = Wedding::create([
            'title' => 'Pernikahan Ahmad & Siti',
            'description' => 'Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan putra-putri kami.',
            'wedding_date' => Carbon::now()->addDays(30),
            'is_active' => true,
            'invitation_code' => 'ahmad-siti-2024',
        ]);

        // Create couple information
        Couple::create([
            'wedding_id' => $wedding->id,
            'groom_name' => 'Ahmad Rizki',
            'groom_nickname' => 'Ahmad',
            'groom_father_name' => 'Budi Santoso',
            'groom_mother_name' => 'Sari Indah',
            'bride_name' => 'Siti Nurhaliza',
            'bride_nickname' => 'Siti',
            'bride_father_name' => 'Joko Widodo',
            'bride_mother_name' => 'Iriana Joko',
            'is_active' => true,
        ]);

        // Create schedules
        Schedule::create([
            'wedding_id' => $wedding->id,
            'type' => 'akad',
            'title' => 'Akad Nikah',
            'description' => 'Akad nikah akan dilaksanakan pada waktu yang telah ditentukan',
            'date' => Carbon::now()->addDays(30),
            'start_time' => Carbon::now()->addDays(30)->setTime(8, 0, 0),
            'end_time' => Carbon::now()->addDays(30)->setTime(10, 0, 0),
            'location' => 'Masjid Al-Ikhlas',
            'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/masjid-al-ikhlas',
            'is_active' => true,
        ]);

        Schedule::create([
            'wedding_id' => $wedding->id,
            'type' => 'resepsi_1',
            'title' => 'Resepsi Sesi 1',
            'description' => 'Resepsi sesi pertama untuk keluarga dan kerabat dekat',
            'date' => Carbon::now()->addDays(30),
            'start_time' => Carbon::now()->addDays(30)->setTime(10, 0, 0),
            'end_time' => Carbon::now()->addDays(30)->setTime(12, 0, 0),
            'location' => 'Gedung Serbaguna',
            'address' => 'Jl. Sudirman No. 456, Jakarta Selatan',
            'maps_url' => 'https://maps.google.com/gedung-serbaguna',
            'is_active' => true,
        ]);

        Schedule::create([
            'wedding_id' => $wedding->id,
            'type' => 'resepsi_2',
            'title' => 'Resepsi Sesi 2',
            'description' => 'Resepsi sesi kedua untuk teman dan kolega',
            'date' => Carbon::now()->addDays(30),
            'start_time' => Carbon::now()->addDays(30)->setTime(14, 0, 0),
            'end_time' => Carbon::now()->addDays(30)->setTime(16, 0, 0),
            'location' => 'Gedung Serbaguna',
            'address' => 'Jl. Sudirman No. 456, Jakarta Selatan',
            'maps_url' => 'https://maps.google.com/gedung-serbaguna',
            'is_active' => true,
        ]);


        // Create sample media
        Media::create([
            'wedding_id' => $wedding->id,
            'type' => 'cover',
            'title' => 'Cover Photo',
            'description' => 'Foto cover undangan pernikahan',
            'file_path' => 'weddings/cover/sample-cover.jpg',
            'file_url' => 'https://example.com/sample-cover.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Media::create([
            'wedding_id' => $wedding->id,
            'type' => 'background',
            'title' => 'Background Photo',
            'description' => 'Foto background undangan',
            'file_path' => 'weddings/background/sample-background.jpg',
            'file_url' => 'https://example.com/sample-background.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Media::create([
            'wedding_id' => $wedding->id,
            'type' => 'gallery',
            'title' => 'Gallery Photo 1',
            'description' => 'Foto prewedding 1',
            'file_path' => 'weddings/gallery/sample-gallery-1.jpg',
            'file_url' => 'https://example.com/sample-gallery-1.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Media::create([
            'wedding_id' => $wedding->id,
            'type' => 'gallery',
            'title' => 'Gallery Photo 2',
            'description' => 'Foto prewedding 2',
            'file_path' => 'weddings/gallery/sample-gallery-2.jpg',
            'file_url' => 'https://example.com/sample-gallery-2.jpg',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Media::create([
            'wedding_id' => $wedding->id,
            'type' => 'background_music',
            'title' => 'Background Music',
            'description' => 'Musik latar belakang undangan',
            'file_path' => 'weddings/music/sample-music.mp3',
            'file_url' => 'https://example.com/sample-music.mp3',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Media::create([
            'wedding_id' => $wedding->id,
            'type' => 'prewedding_video',
            'title' => 'Prewedding Video',
            'description' => 'Video prewedding pasangan',
            'file_path' => '',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // Create sample guests
        Guest::create([
            'wedding_id' => $wedding->id,
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'session' => 'session_1',
            'notes' => 'Keluarga dari pihak mempelai pria',
            'is_active' => true,
        ]);

        Guest::create([
            'wedding_id' => $wedding->id,
            'name' => 'Sari Indah',
            'email' => 'sari@example.com',
            'phone' => '081234567891',
            'session' => 'session_1',
            'notes' => 'Keluarga dari pihak mempelai wanita',
            'is_active' => true,
        ]);

        Guest::create([
            'wedding_id' => $wedding->id,
            'name' => 'Rudi Kurniawan',
            'email' => 'rudi@example.com',
            'phone' => '081234567892',
            'session' => 'session_2',
            'notes' => 'Teman kerja mempelai pria',
            'is_active' => true,
        ]);

        Guest::create([
            'wedding_id' => $wedding->id,
            'name' => 'Maya Sari',
            'email' => 'maya@example.com',
            'phone' => '081234567893',
            'session' => 'session_2',
            'notes' => 'Teman kuliah mempelai wanita',
            'is_active' => true,
        ]);

        Guest::create([
            'wedding_id' => $wedding->id,
            'name' => 'Pak Haji Ahmad',
            'email' => 'haji.ahmad@example.com',
            'phone' => '081234567894',
            'session' => 'both',
            'notes' => 'Tetangga dekat, diundang kedua sesi',
            'is_active' => true,
        ]);
    }
}
