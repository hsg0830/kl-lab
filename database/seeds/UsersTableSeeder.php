<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'age' => 41,
            'sex' => 'M',
            'password' => bycrypt('admin'),
            'is_admin' => 1,
            'permission' => 1,
            ]);

        DB::table('users')->insert([
            'name' => 'test01',
            'email' => 'test01@gmail.com',
            'age' => 32,
            'sex' => 'F',
            'password' => bycrypt('test01'),
            ]);
    }
}
