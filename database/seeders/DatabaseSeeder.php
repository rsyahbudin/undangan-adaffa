<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wedding;
use App\Models\Guest;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat wedding
        $wedding = Wedding::create([
            'bride_name' => 'Nadia Ariandyen',
            'bride_nickname' => 'Nadia',
            'bride_photo' => 'weddings/photos/01K5QKZJV6KYSP1BWV7MJM6SZ3.jpg',
            'bride_father_name' => 'Bokap Nadia',
            'bride_mother_name' => 'Nyokap Nadia',
            'groom_name' => 'Muhammad Daffa Syahbudin',
            'groom_nickname' => 'Daffa',
            'groom_photo' => 'weddings/photos/01K5QKZJVA2H3QGKVV1ZEWXAWS.jpg',
            'groom_father_name' => 'Agus Syahbudin',
            'groom_mother_name' => 'Evie Sofiany',
            'akad_date' => '2025-12-04',
            'akad_start_time' => '08:00:00',
            'akad_end_time' => '10:00:00',
            'akad_place' => 'Teras Rumah Nenek',
            'reception1_date' => '2025-12-04',
            'reception1_start_time' => '10:00:00',
            'reception1_end_time' => '00:00:00',
            'reception1_place' => 'Teras Rumah Nenek',
            'reception2_date' => '2025-12-04',
            'reception2_start_time' => '19:00:00',
            'reception2_end_time' => '21:00:00',
            'reception2_place' => 'Teras Rumah Nenek',
            'maps_url' => 'https://maps.app.goo.gl/QAzjtLeMUWqMSaE16',
        ]);

        // Buat guests
        $guests = [
            [
                'name' => 'aa',
                'phone' => '123412',
                'email' => 'admin1@example.com',
                'session' => 1,
                'guest_count' => 1,
                'is_invited' => true,
                'is_active' => true,
            ],
            [
                'name' => 'rafly',
                'phone' => '8312',
                'email' => 'syahbudin@gmail.com',
                'session' => 2,
                'guest_count' => 2,
                'is_invited' => true,
                'is_active' => true,
            ],
        ];

        foreach ($guests as $guestData) {
            $wedding->guests()->create($guestData);
            // slug otomatis akan dibuat oleh model
        }

        // Buat setting
        Setting::firstOrCreate(
            ['wedding_id' => $wedding->id],
            [
                'cover_photo' => 'covers/01K5QM1FH28BEAT0MNMT03DJCB.jpg',
                'music_path' => 'music/01K5QM1FH581XXM0H72M3DVM88.mp3',
            ]
        );

        // Buat admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
