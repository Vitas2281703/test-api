<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminVoyagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert([
            'role_id' => 1,
            'login' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'city' => 'Кемерово',
            'phone' => '88005553535',
            'birthday' => '02.01.2001',
            'password' => Hash::make('123'),
        ]);
    }
}
