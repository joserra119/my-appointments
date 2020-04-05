<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    	'name' => 'Jose Ramon',
        'email' => 'joserra119@hotmail.com',
        'password' => bcrypt('joserra'),
        'dni' =>'47072229S',
        'address'=>'Cervantes 22',
        'phone'=>'637036654',
        'role'=>'admin'
    	]);
        factory(User::class, 50)->create();

    }
    
}
