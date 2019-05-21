<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'login' => 'Администратор',
                'email' => 'admin@g.ru',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ],
            [
                'login' => 'User_1',
                'email' => 'user_1@g.ru',
                'password' => bcrypt('user123'),
                'is_admin' => false,
            ],
            [
                'login' => 'Клиент',
                'email' => 'klient@g.ru',
                'password' => bcrypt('klient123'),
                'is_admin' => false,
            ],
        ];
        DB::table('users')->insert($data);
    }
}
