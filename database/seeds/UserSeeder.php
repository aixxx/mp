<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'name'     => 'admin',
                'password' => Hash::make('viease'),
                'email'    => 'admin@viease.com',
                'is_admin' => 1,
            ]);
    }
}
