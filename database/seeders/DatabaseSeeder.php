<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Pengguna::factory()->create();

        \App\Models\Pengguna::factory()->create([
            'nama' => "Jessica",
            'email' => "jessica@admin.ve",
            'password' => Hash::make("admin"),
            'role' => "admin",
        ]);
        \App\Models\Pengguna::factory()->create([
            'nama' => "Veranda",
            'email' => "veranda@admin.ve",
            'password' => Hash::make("pengguna"),
            'role' => "pengguna",
        ]);
    }
}
