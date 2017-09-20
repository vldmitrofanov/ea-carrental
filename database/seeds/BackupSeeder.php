<?php

use Illuminate\Database\Seeder;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        
        $path = 'database/backup/insert.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('backup seeded!');
    }
}
