<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // you can use: save() / create() /createMany()
        //insert()
        $users = [
            [
                'name' =>  'Anna',
                'email' =>  'anna@mail.com',
                'password' =>  Hash::make('password'),
                'role_id' =>  1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' =>  'Peter',
                'email' => 'peter@mail.com' ,
                'password' => Hash::make('password'),
                'role_id' =>  2,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->user->insert($users); //insert into users table
    }
}