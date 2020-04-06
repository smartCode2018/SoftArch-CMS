<?php

Use App\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'smartcode.kc@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Justice Kelechi',
                'email'=> 'smartcode.kc@gmail.com',
                'role'=> 'admin',
                'password'=> Hash::make('letscode')
            ]);
        }
    }
}
