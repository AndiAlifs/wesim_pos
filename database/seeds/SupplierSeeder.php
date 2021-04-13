<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $faker = Faker\Factory::create();


        $data[0] = [
            'name' => 'UMUM',
            'phone' => '',
            'address' => '',
            'description' => '',
        ];
        $data[1] = [
            'name' => 'Bang Jago',
            'phone' => '+62 12345678',
            'address' => $faker->address,
            'description' => $faker->sentence(5),
        ];

        $data[2] = [
            'name' => "Raja Pemasok",
            'phone' => '+62 12345678',
            'address' => $faker->address,
            'description' => $faker->sentence(5),
        ];

        $data[3] = [
            'name' => 'Gaada Ahlak',
            'phone' => '+62 12345678',
            'address' => $faker->address,
            'description' => $faker->sentence(5),
        ];

        DB::table('suppliers')->insert($data);
    }
}