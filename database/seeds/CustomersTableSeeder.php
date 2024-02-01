<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
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
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => '$2y$10$TUfePGXn0NmRjk/UAR./.OqEEpWR0cqzzTg6fhmsA4JDeKAo1td1C', //123456
                'phone' => '+004412345678',
                'post_code' => 'B23 6SN',
                'address' => '12 State road, B23 6SN 520',
                'status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        Customer::insert($data);
    }
}
