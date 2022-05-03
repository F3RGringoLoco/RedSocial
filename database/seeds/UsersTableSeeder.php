<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profesional;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'john@gmail.com',
            'password' => bcrypt(12345678),
            'remember_token' =>  Str::random(60),
        ]);

        Profesional::create([
            'name' => 'John Doe',
            'birth' => '1997-03-12',
            'phone' => '12345678',
            'career' => 'INGENIERIA INFORMATICA',
            'user_id' => $user->id,
        ]);
    }
}
