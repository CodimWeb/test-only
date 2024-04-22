<?php

namespace Database\Seeders;

use App\Models\Comfort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComfortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comforts = [
            [
                'name' => 'Economy',
            ],
            [
                'name' => 'Business',
            ],
            [
                'name' => 'Premium',
            ],
        ];

        foreach ($comforts as $comfort) {
            Comfort::firstOrCreate($comfort);
        }
    }
}
