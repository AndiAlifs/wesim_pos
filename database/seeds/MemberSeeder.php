<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $faker = Faker::create('id_ID');
    
        for($i = 1; $i <= 10; $i++){
    
            // insert data ke table pegawai menggunakan Faker
            DB::table('members')->insert([
                'member_code' => $faker->numberBetween(1000000,9999999),
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'point' => $faker->numberBetween(25,40),
            ]);
        }
 
    }
}
