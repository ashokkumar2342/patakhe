<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sellers')->insert([
            'first_name' => 'Mayank',
            'last_name' => 'kumar',
            'email' => 'seller@gmail.com',
            'mobile' => '9386495527',
            'password' => bcrypt('123123'),
            'status'    => '1'
        ]);
        // $faker = faker::create('App\Seller');
        // for($i =1; $i<=50; $i++){
        //      DB::table('sellers')->insert([
        //         'first_name' => $faker->firstName,
        //         'last_name' => $faker->lastName,
        //         'email' => $faker->email,
        //         'mobile' => rand(100000000,999999999),
        //         'password' => bcrypt('123123'),
        //         'created_at' =>   Carbon::now(),
        //         'updated_at' =>   Carbon::now(),
        //         'status' => 1,
        //     ]);   
        // }
    }
}
