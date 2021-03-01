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

        for($i=0;$i<5;$i++){
            $data[$i] = [
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'username' => $faker->unique()->userName,
                    'role_id' => rand(1,3),
                    'password' => bcrypt('12345'),
                ];
        }
        DB::table('users')->insert($data);
    }
}
