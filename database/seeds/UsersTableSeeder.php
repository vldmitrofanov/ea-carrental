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
        DB::table('users')->insert([
            'name' => 'Muhammad Idrees',
            'username' => 'admin',
            'email' => 'medriis@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
