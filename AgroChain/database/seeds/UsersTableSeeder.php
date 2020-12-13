<?php

use App\User;
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
        User::truncate();


        User::create([
            'name' => 'admin',
            'account' => '0x9099C6194192b589F808c62552E412FC944F34f6',
            'email' => 'doanepal@gov.np',
            'password' => bcrypt('admin'),
            'isAdmin' => 1
        ]);

        User::create([
            'name' => 'Aabiskar Pandey',
            'account' => '0xff1aECD865B68696881892728526dA3a82EEbe71',
            'email' => 'pandeyaabiskar@gmail.com',
            'password' => bcrypt('aabiskar')
        ]);

//        User::create([
//            'name' => 'Aahishma Khanal',
//            'account' => '0x538301CCfBADd232592972Bf0892390E21d7b319',
//            'email' => 'aahishma@gmail.com',
//            'password' => bcrypt('aahishma')
//        ]);
//
//        User::create([
//            'name' => 'Tayouth Malla',
//            'account' => '0x424C583D706D142E839D63fDCD7F7488E061dDEB',
//            'email' => 'tayouth@gmail.com',
//            'password' => bcrypt('tayouth')
//        ]);
    }
}
