<?php

use SIC\Models\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
        	'username' => 'utkarsh',
        	'email' => 'utkarshvishnoi25@gmail.com',
        	'password' => bcrypt('secret'),
            'first_name' => 'Utkarsh',
            'last_name' => 'Vishnoi'
        ]);

        Student::create([
        	'username' => 'rajendra',
        	'email' => 'r.bisht98@gmail.com',
        	'password' => bcrypt('secret'),
            'first_name' => 'Rajendra',
            'last_name' => 'Bisht'
        ]);
    }
}
