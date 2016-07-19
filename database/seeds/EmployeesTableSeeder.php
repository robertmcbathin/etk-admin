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
        DB::table('EMPLOYEES')->insert([
        	'ID' => 222,
        	'USERNAME' => 'test1',
        	'FIRST_NAME' => 'Тест',
        	'SECOND_NAME' => 'Тест',
        	'PSW' => bcrypt('data-2014')
        ]);
    }
}
