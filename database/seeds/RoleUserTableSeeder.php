<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'user_id' => \App\User::where('username', 'admin')->first()->id,
                'role_id' => \App\Role::where('name', 'admin')->first()->id
            ]
        ];

        DB::table('role_user')->insert($users);
    }
}
