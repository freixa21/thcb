<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        self::generarUserTest();
    }

    public static function generarUserTest() {
        $u = new User();

        $u->name = 'admin';
        $u->email = 'admin@hockeycostabrava.com';
        $u->password = Hash::make('Almax1821.');
        $u->phone = '630206438'; 
        $u->save();
    }
}
