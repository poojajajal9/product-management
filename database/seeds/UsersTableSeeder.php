<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->create([
            'name' => 'Pooja Jajal',
            'email' => 'poojajajal9d@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('123456')
        ]);
    }
}
