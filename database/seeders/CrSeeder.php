<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cr;
use Illuminate\Support\Facades\Hash;

class CrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cr::create([
            'cr_name' => 'Test CR',
            'cr_email' => 'cr@example.com',
            'reg_no' => 'CR001',
            'section' => 'A',
            'semester' => '1',
            'password' => Hash::make('password123'),
        ]);
    }
}
