<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'model' => 'Lada',
                'comfort_lvl' => '1',
                'user_id' => 18
            ],
            [
                'model' => 'Kia',
                'comfort_lvl' => '2',
                'user_id' => 19
            ],
            [
                'model' => 'Audi',
                'comfort_lvl' => '3',
                'user_id' => 20
            ],
        ];

        foreach ($cars as $car) {
            Car::firstOrCreate($car);
        }
    }
}
