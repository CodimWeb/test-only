<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comfort;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(ComfortSeeder::class);

        User::factory(20)->create();

        $users = User::orderBy('id', 'asc')->limit(17)->get();

        foreach ($users as $user) {
            $role = Role::query()->where('label', '!=', 'Driver')->inRandomOrder()->first();
            $user->role_id = $role->id;
            $user->save();
        }


        $roles = Role::where('label', '!=', 'Driver')->get();
        $comforts = Comfort::all();

        foreach ($roles as $key => $role) {
            $roles[$key]->comfort()->sync($comforts[$key]->id);
        }
//
        // make Drivers
        $users = User::orderBy('id', 'desc')->limit(3)->get()->reverse();
        foreach ($users as $user) {
            $user->role_id = 4;
            $user->save();
        }
//
        $this->call(CarSeeder::class);
    }
}
