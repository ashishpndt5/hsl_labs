<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provider;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Provider::insert([
            ['name' => 'Dr. Helen Jahn', 'email' => 'helen.jahn@hsl.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dr. Douglas Elliot', 'email' => 'douglas.elliot@hsl.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dr. John Adams', 'email' => 'john.adams@hsl.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
