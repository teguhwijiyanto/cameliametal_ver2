<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Shift::insert([
            [
                'name'          => 'Shift 1',
                'start_time'    => '08:00',
                'end_time'      => '17:00',
                'break_1_start' => '10:00',
                'break_1_end'   => '10:15',
                'break_2_start' => '12:00',
                'break_2_end'   => '13:00',
                'break_3_start' => '15:00',
                'break_3_end'   => '15:15',
                'break_4_start' => null,
                'break_4_end'   => null,
                'break_5_start' => null,
                'break_5_end'   => null,
                'background_color'  => 'rgb(25, 105, 44)'
            ],
            [
                'name'          => 'Shift 2',
                'start_time'    => '17:00',
                'end_time'      => '24:00',
                'break_1_start' => '18:00',
                'break_1_end'   => '19:00',
                'break_2_start' => '21:00',
                'break_2_end'   => '21:15',
                'break_3_start' => null,
                'break_3_end'   => null,
                'break_4_start' => null,
                'break_4_end'   => null,
                'break_5_start' => null,
                'break_5_end'   => null,
                'background_color'  => 'rgb(0, 86, 179)'
            ],
            [
                'name'          => 'Shift 3',
                'start_time'    => '24:00',
                'end_time'      => '08:00',
                'break_1_start' => '02:00',
                'break_1_end'   => '02:15',
                'break_2_start' => '04:00',
                'break_2_end'   => '05:00',
                'break_3_start' => '06:00',
                'break_3_end'   => '06:15',
                'break_4_start' => null,
                'break_4_end'   => null,
                'break_5_start' => null,
                'break_5_end'   => null,
                'background_color'  => 'rgb(186, 139, 0)'
            ]
        ]);
    }
}
