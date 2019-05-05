<?php

use Illuminate\Database\Seeder;

class PC_ClubPCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PC = [];

        $PC_name = 'Администратор';
        $PC[] = [
            //'id' => 0,
            'PC_Name' => $PC_name,

        ];

        for ($i = 1; $i <= 10; $i++){
            $PC_name = 'PC_'.$i;


            $PC[]= [
                'PC_Name' => $PC_name,

            ];
        }
        DB::table('pc_club_pc')->insert($PC);
    }
}
