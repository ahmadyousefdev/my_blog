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
            'name' => 'Admin',
            'email' => 'admin@test.local',
            'password' => bcrypt('121212'),
            'created_at' => '2020-01-01 14:28:15',
            'updated_at' => '2020-01-01 14:28:15'
        ]);
    }
}
