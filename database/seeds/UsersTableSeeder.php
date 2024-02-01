<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => '$2y$10$TUfePGXn0NmRjk/UAR./.OqEEpWR0cqzzTg6fhmsA4JDeKAo1td1C', //123456
                'role' => 'super-admin',
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$TUfePGXn0NmRjk/UAR./.OqEEpWR0cqzzTg6fhmsA4JDeKAo1td1C', //123456
                'role' => 'admin',
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        User::insert($data);
    }
}
