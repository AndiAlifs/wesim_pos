<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $data[0] = ['role_name' => "Admin"];
        $data[1] = ['role_name' => "Owner"];
        $data[2] = ['role_name' => "Cashier"];
        
        DB::table('roles')->insert($data);
    }
}
