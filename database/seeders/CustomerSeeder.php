<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customers;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customers::create([
            'name' => 'Rafif',
            'email' => 'rafif123@gmail.com',
            'phone' => '12345678',
            'password' => bcrypt('12345678')
        ]);

        Customers::create([
            'name' => 'Jamal',
            'email' => 'jamal@gmail.com',
            'phone' => '12345678',
            'password' => bcrypt('12345678')
        ]);
    }
}