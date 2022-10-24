<?php

namespace Database\Seeders;

use App\Models\Breaktime;
use Illuminate\Database\Seeder;

class BreaktimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Breaktime::create([
            'name'  => '08.00',
            'name2' => '08.15'
        ]);
    }
}
