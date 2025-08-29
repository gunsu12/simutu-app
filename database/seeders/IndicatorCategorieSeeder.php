<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Indicator_categorie;

class IndicatorCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Indikator Unit', 'description' => 'Ini merupakan indikator mutu untuk unit'],
            ['name' => 'Indikator Sasaran Keselamatan Pasien', 'description' => 'ini merupakan indikator sasaran keselamatan pasien'],
            ['name' => 'Indikator Nasional', 'description' => 'Ini merupakan indikator mutu untuk Nasional'],
            ['name' => 'Indikator K3RS', 'description' => 'Ini merupakan indikator mutu untuk K3RS'],
            ['name' => 'Indikator PPI', 'description' => 'Ini merupakan indikator mutu untuk PPI'],
            ['name' => 'Indikator Kontrak', 'description' => 'Ini merupakan indikator mutu untuk Kontrak'],
            ['name' => 'Indikator Rumah Sakit', 'description' => 'Indikator Rumah Sakit'],
        ];

        foreach ($categories as $categorie) {
            Indicator_categorie::create([
                'name' => $categorie['name'],
                'description' => $categorie['description'],
            ]);
        }
    }
}
