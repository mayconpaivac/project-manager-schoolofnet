<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\ManagerProject\Entities\User::class)->create([
        	'name'	=> 'Maycon Paiva',
        	'email' => 'mayconpaivac@gmail.com',
        	'password' => bcrypt(123456)
        ]);
        
        factory(\ManagerProject\Entities\User::class, 10)->create();
    }
}
