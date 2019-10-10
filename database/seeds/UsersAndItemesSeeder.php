<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\User;

class UsersAndItemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10000)->create();
        factory(User::class, 100)->create();
    }
}
