<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = '58Gg,902k';
        DB::table('employees')->insert([
        	'ID' => 2,
        	'USERNAME' => 'gorbunov',
        	'FIRST_NAME' => 'Артем',
        	'SECOND_NAME' => 'Горбунов',
        	'PASSWORD' => bcrypt($password),
            'ROLE' => 'admin'
        ]);
    }
}
