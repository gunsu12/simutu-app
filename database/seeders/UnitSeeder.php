<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;       // <-- Import model Unit
use App\Models\Division;   // <-- Import model Division

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Siapkan data unit beserta NAMA divisinya
        $units = [
            // Unit di bawah 'Keuangan dan Umum'
            ['name' => 'Akuntansi', 'division_name' => 'Keuangan dan Umum'],
            ['name' => 'SDM & Personalia', 'division_name' => 'Keuangan dan Umum'],

            // Unit di bawah 'Penunjang Medis'
            ['name' => 'Laboratorium', 'division_name' => 'Penunjang Medis'],
            ['name' => 'Radiologi', 'division_name' => 'Penunjang Medis'],
            ['name' => 'Farmasi', 'division_name' => 'Penunjang Medis'],

            // Unit di bawah 'Pelayanan Medis'
            ['name' => 'Rawat Jalan', 'division_name' => 'Pelayanan Medis'],
            ['name' => 'Rawat Inap', 'division_name' => 'Pelayanan Medis'],
            ['name' => 'IGD', 'division_name' => 'Pelayanan Medis'],

            // dibawah corporate
            ['name' => 'IT / SIMRS', 'division_name' => 'Corporate'],
        ];

        // Lakukan looping untuk setiap unit
        foreach ($units as $unitData) {
            // 1. Cari divisi berdasarkan nama untuk mendapatkan ID-nya
            $division = Division::where('name', $unitData['division_name'])->first();

            // 2. Jika divisi ditemukan, buat unit baru dengan division_id yang sesuai
            if ($division) {
                Unit::create([
                    'name' => $unitData['name'],
                    'division_id' => $division->id, // <-- Mapping terjadi di sini
                    // 'description' => 'Opsional',
                ]);
            }
        }
    }
}
