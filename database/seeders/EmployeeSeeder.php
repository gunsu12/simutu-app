<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Employee::create([
            'full_name' => 'Admin',
            'email' => 'sysadmin@baliroyalhospital.co.id',
            'phone_number' => '087865468492',
            'unit_id' => '1', // <-- Pilih ID unit secara acak
            'position' => 'System Administrator',
            'status' => 'active',
        ]);

        Employee::factory()->count(20)->create();
    }
}
