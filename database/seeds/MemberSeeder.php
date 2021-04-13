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

        DB::table('members')->insert([
            'name' => 'UMUM',
            'member_id' => 1000001,
            'phone' => '',
            'email' => '',
            'address' => '',
            'point' => 0,
        ]);

        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 100; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('members')->insert([
                'name' => $faker->name,
                'member_id' => $faker->numberBetween(1000002, 9999999),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'point' => $faker->numberBetween(25, 40),
            ]);
        }
    }
}