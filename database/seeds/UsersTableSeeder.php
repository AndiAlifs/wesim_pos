<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'username' => 'admin',
                'role_id' => 1,
                'password' => bcrypt('password'),
        ];

        $data[1] = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'username' => 'owner',
            'role_id' => 2,
            'password' => bcrypt('password'),
        ];

        $data[2] = [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => 'cashier',
        'role_id' => 3,
        'password' => bcrypt('password'),
        ];

        $data[3] = [
        'name' => "Fatwa Anugerah Nasir",
        'email' => "fatwaanugerah0421@gmail.com",
        'username' => 'fatwaanugerah21',
        'role_id' => 1,
        'password' => bcrypt('fatwa'),
        ];

        DB::table('users')->insert($data);
    }
}
