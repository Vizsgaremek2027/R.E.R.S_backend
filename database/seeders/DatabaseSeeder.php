<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. FELHASZNÁLÓK
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kiss Péter',
                'email' => 'peter@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Resident',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nagy Anna',
                'email' => 'anna@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Resident',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Szabó Gábor',
                'email' => 'gabor@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Resident',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. LAKÁSOK
        $users = DB::table('users')->get()->keyBy('email');

        DB::table('apartments')->insert([
            [
                'door_number' => '101',
                'user_id' => $users['peter@example.com']->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'door_number' => '102',
                'user_id' => $users['anna@example.com']->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'door_number' => '201',
                'user_id' => $users['gabor@example.com']->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 3. HIBABEJELENTÉSEK
        $apartments = DB::table('apartments')
            ->get()
            ->keyBy('door_number');

        DB::table('issues')->insert([
            [
                'apartment_id' => $apartments['101']->id,
                'title' => 'Csőtörés a fürdőszobában',
                'description' => 'Szivárog a vízcső a fürdőszobában.',
                'category' => 'Plumbing',
                'image_path' => 'issues/water_leak.jpg',
                'status' => 'Pending',
                'archived_at' => null,
            ],
            [
                'apartment_id' => $apartments['102']->id,
                'title' => 'Nem működik a lift',
                'description' => 'A lift nem indul el a földszintről.',
                'category' => 'Elevator',
                'image_path' => 'issues/elevator.jpg',
                'status' => 'In Progress',
                'archived_at' => null,
            ],
            [
                'apartment_id' => $apartments['201']->id,
                'title' => 'Fűtési probléma',
                'description' => 'A radiátor nem melegszik fel.',
                'category' => 'Heating',
                'image_path' => 'issues/heating.jpg',
                'status' => 'Pending',
                'archived_at' => null,
            ],
        ]);

        // 4. MÉRŐÓRA-LEOLVASÁSOK
        DB::table('meter_readings')->insert([
            [
                'apartment_id' => $apartments['101']->id,
                'utility_type' => 'Water',
                'reading_value' => 125.50,
                'photo_path' => 'meter_readings/water_101.jpg',
                'reading_date' => '2026-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => $apartments['101']->id,
                'utility_type' => 'Electricity',
                'reading_value' => 2450.75,
                'photo_path' => 'meter_readings/electricity_101.jpg',
                'reading_date' => '2026-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => $apartments['102']->id,
                'utility_type' => 'Gas',
                'reading_value' => 350.25,
                'photo_path' => 'meter_readings/gas_102.jpg',
                'reading_date' => '2026-11-02',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => $apartments['201']->id,
                'utility_type' => 'Water',
                'reading_value' => 89.30,
                'photo_path' => 'meter_readings/water_201.jpg',
                'reading_date' => '2026-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. ARCHIVÁLT FELHASZNÁLÓK
        // Kezdetben üresen hagyjuk.
    }
}
