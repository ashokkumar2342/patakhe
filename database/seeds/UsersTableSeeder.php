<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = faker::create('App\User');
        // for($i =1; $i<=50; $i++){
        //      DB::table('users')->insert([
        //         'first_name' => $faker->firstName,
        //         'last_name' => $faker->lastName,
        //         'email' => $faker->email,
        //         'mobile' => rand(100000000,999999999),
        //         'password' => bcrypt('123123'),
        //         'member_status' => 1,
        //         'created_at' =>   Carbon::now(),
        //         'updated_at' =>   Carbon::now(),
        //         'status' => 1,
        //     ]);   
        // }
       
    }
}
