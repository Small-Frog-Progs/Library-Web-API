<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            [
                'name'  =>  'Ivan Ivanov',
                'email'  =>  'a@a.a',
                'password'  =>  Hash::make('123321'),
                'is_admin'  =>  true,
                'remember_token'    =>  'ATzcaKKDNsseoWt2Hl1VkKiuAFF3p4RgShw4dBonrUCAJSlvUFxxpt34UqKIpGxzBXslI7uc4bU3nqU9T70P517KepCC8tNHg3pZ',
            ]
        ]);
    }
}
