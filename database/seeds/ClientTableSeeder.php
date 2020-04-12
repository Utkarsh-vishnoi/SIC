<?php

use SIC\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
        	'username' => 'utkarsh',
        	'password' => bcrypt('secret')
        ]);
    }
}
