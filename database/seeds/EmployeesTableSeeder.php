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
        $password = 'data-2014';
        DB::table('EMPLOYEES')->insert([
        	'ID' => 228,
        	'USERNAME' => 'test5',
        	'FIRST_NAME' => 'Тест',
        	'SECOND_NAME' => 'Тест',
        	'PASSWORD' => bcrypt($password),
            'ROLE' => 'card_reg'
        ]);
    }
}
