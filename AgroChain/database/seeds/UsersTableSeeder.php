<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();


        User::create([
            'name' => 'Insurer Admin',
            'account' => '0xCf98e5D7EDd891E3C072258cA25097dB5a0B0fB1',
            'email' => 'insurance@insurance.com',
            'password' => Hash::make('admin'),
            'isAdmin' => 1
        ]);

        User::create([
            'name' => 'Risk Manager',
            'account' => '0xa0B05F1f7e1273829b4aaf617593CEa7F24605eD',
            'email' => 'riskmanager@insurance.com',
            'password' => Hash::make('riskmanager'),
            'isAdmin' => 2
        ]);

        User::create([
            'name' => 'Aabiskar Pandey',
            'account' => '0x1Cde0860963f355D0acf475eD662B3b151dC12c7',
            'email' => 'pandeyaabiskar@gmail.com',
            'password' => Hash::make('aabiskar')
        ]);

    //    User::create([
    //        'name' => 'Shubham Joshi',
    //        'account' => '0x66AEc59508eA4CCB4185f1a0F39EA6f79D61Db3E',
    //        'email' => 'shubham@gmail.com',
    //        'password' => Hash::make('shubham')
    //    ]);

    //    User::create([
    //        'name' => 'Tayouth Malla',
    //        'account' => '0x7c05d5205fb517bEF12a8B0b8dfADeFa5d7Cb9b5',
    //        'email' => 'tayouth@gmail.com',
    //        'password' => Hash::make('tayouth')
    //    ]);
    }
}
