<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        $user =[
            [
                'username'=> 'admin',
                'password'=> bcrypt('admin'),
                'name'=> 'Admin',
                'level'=> 'admin'
            ],
            [
                'username'=> 'Erlangga',
                'password'=> bcrypt('1234'),
                'name' => 'Erlangga',
                'level' => 'siswa'
            ]
            ];
            foreach ($user as $key => $value ){
                User::create($value);
            }
    }
}