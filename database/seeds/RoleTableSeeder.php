<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $users = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'editor'
            ],
            [
                'name' => 'customer'
            ]
        ];

        DB::table('roles')->insert($users);
    }
}
