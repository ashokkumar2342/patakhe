<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('admins')->insert([
            'first_name' => 'Amar',
            'last_name' => 'kumar singh',
            'email' => 'amarkumar004@gmail.com',
            'mobile' => '9386495527',
            'password' => bcrypt('123123'),
            'role'  => 1,
            'permission'  => 1,
            'created_at' =>   Carbon::now(),
            'updated_at' =>   Carbon::now(),
            'status'    => 1
        ]);
         DB::table('admins')->insert([
            'first_name' => 'Amar',
            'last_name' => 'kumar singh',
            'email' => 'developeramarkumar@gmail.com',
            'mobile' => '7082690096',
            'password' => bcrypt('123123'),
            'role'  => 1,
            'permission'  => 1,
            'created_at' =>   Carbon::now(),
            'updated_at' =>   Carbon::now(),
            'status'    => 1
        ]);
        DB::table('admins')->insert([
            'first_name' => 'Amar',
            'last_name' => 'kumar singh',
            'email' => 'kitkirtikaushik90@gmail.com',
            'mobile' => '8059283581',
            'password' => bcrypt('987654'),
            'role'  => 2,
            'created_at' =>   Carbon::now(),
            'updated_at' =>   Carbon::now(),
            'status'    => 1
        ]);
        DB::table('admins')->insert([
            'first_name' => 'Neeraj',
            'last_name' => 'Malik',
            'email' => 'mneeraj014@gmail.com',
            'mobile' => '9050989574',
            'password' => bcrypt('anu123'),
            'role'  => 2,
            'created_at' =>   Carbon::now(),
            'updated_at' =>   Carbon::now(),
            'status'    => 1
        ]);
        DB::table('admins')->insert([
            'first_name' => 'Ashok',
            'last_name' => 'kumar',
            'email' => 'ashokkumar2342@gmail.com',
            'mobile' => '8083274127',
            'password' => bcrypt('123123'),
            'role'  => 1,
            'permission'  => 1,
            'created_at' =>   Carbon::now(),
            'updated_at' =>   Carbon::now(),
            'status'    => 1
        ]);
    }
    
}
