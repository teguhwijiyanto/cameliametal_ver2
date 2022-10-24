<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(RolesTableSeeder::class);
        // $this->call(AdminUserTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(MachineSeeder::class);
        $this->call(ShiftSeeder::class);

        \App\Models\Customer::factory(10)->create();
        \App\Models\Supplier::factory(10)->create();
    }
}
