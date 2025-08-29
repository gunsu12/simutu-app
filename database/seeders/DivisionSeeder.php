<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Siapkan data divisi dalam bentuk array
        $divisions = [
            ['name' => 'Keuangan dan Umum'],
            ['name' => 'Penunjang Medis'],
            ['name' => 'Pelayanan Medis'],
            ['name' => 'Fungsional'],
            ['name' => 'Corporate'],
        ];

        // 2. Lakukan looping dan buat record menggunakan model
        foreach ($divisions as $division) {
            Division::create([
                'name' => $division['name'],
            ]);
        }
        // Catatan: Dengan create(), 'created_at' dan 'updated_at'
        // akan terisi otomatis oleh Eloquent.
    }
}
