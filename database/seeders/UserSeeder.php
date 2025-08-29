<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;                   // <-- Import model User
use Illuminate\Support\Facades\Hash;   // <-- Import Hash Facade untuk enkripsi

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'SysAdmin',
            'email' => 'sysadmin@baliroyalhospital.co.id',
            'password' => Hash::make('123456'),
        ]);
    }
}
