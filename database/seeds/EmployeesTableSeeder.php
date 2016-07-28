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
        $password1 = '58Gg,902k';
        $password2 = 'ormis-7612';
        $password3 = 'tyFS45-yu';
        $password4 = 'bvTOj58g-r';
        $password5 = 'fj58-jcfhGG4';
  /*      DB::table('employees')->insert([
            'ID' => 3,
            'USERNAME' => 'arlashkin',
            'FIRST_NAME' => 'Евгений',
            'SECOND_NAME' => 'Аплашкин',
            'PASSWORD' => bcrypt($password2),
            'ROLE' => 'admin'
        ]);
        DB::table('employees')->insert([
            'ID' => 4,
            'USERNAME' => 'dimon',
            'FIRST_NAME' => 'Просто',
            'SECOND_NAME' => 'Димон',
            'PASSWORD' => bcrypt($password3),
            'ROLE' => 'admin'
        ]);
        DB::table('employees')->insert([
            'ID' => 5,
            'USERNAME' => 'lev',
            'FIRST_NAME' => 'Лев',
            'SECOND_NAME' => 'Швецов',
            'PASSWORD' => bcrypt($password4),
            'ROLE' => 'admin'
        ]);
*/
        DB::table('employees')->insert([
            'ID' => 6,
            'USERNAME' => 'anna',
            'FIRST_NAME' => 'Анна',
            'SECOND_NAME' => 'Элиберова',
            'PASSWORD' => bcrypt($password5),
            'ROLE' => 'admin'
        ]);

    }
}
