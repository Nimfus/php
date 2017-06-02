<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("SET foreign_key_checks = 0;");

        DB::table('roles')->truncate();

        DB::table('roles')->insert(
            [
                'name' => 'Administrator',
                'slug' => 'admin',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
            ]
        );

        DB::unprepared("SET foreign_key_checks = 1;");
    }
}
