<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(StoreTableSeeder::class);
        $this->call(ThemeTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(OtherSeeder::class);
    }
}
