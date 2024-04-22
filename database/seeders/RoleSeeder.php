<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'manager',
                'label' => 'Менеджер'
            ],
            [
                'name' => 'department_head',
                'label' => 'Начальник отдела'
            ],
            [
                'name' => 'Директор',
                'label' => 'Director'
            ],
            [
                'name' => 'Водитель',
                'label' => 'Driver'
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
