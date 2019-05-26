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
            'id' => 1,
            'PC_Name' => $PC_name,

        ];

        for ($i = 2; $i <= 11; $i++){
            $n = $i-1;
            $PC_name = 'PC_'.$n;


            $PC[]= [
                'id' => $i,
                'PC_Name' => $PC_name,

            ];
        }
        DB::table('p_c__club_p_c_s')->insert($PC);
    }
}
