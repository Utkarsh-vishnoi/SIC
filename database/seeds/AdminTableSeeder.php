<?php

use Illuminate\Database\Seeder;

use SIC\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
        	'username' => 'utkarsh',
        	'email' => 'utkarshvishnoi25@gmail.com',
        	'password' => bcrypt('secret'),
            'first_name' => 'Utkarsh',
            'last_name' => 'Vishnoi'
        ]);

        Admin::create([
        	'username' => 'rajendra',
        	'email' => 'r.bisht98@gmail.com',
        	'password' => bcrypt('secret'),
            'first_name' => 'Rajendra',
            'last_name' => 'Bisht'
        ]);
    }
}
