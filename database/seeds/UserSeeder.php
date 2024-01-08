<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkExistUser = User::where('name', 'admin')->where('email', 'admin@gmail.com')->count();
        if(!$checkExistUser){
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(123456789),
                'role' => User::USER_ADMIN_ROLE,
                'status' => 1
            ]);
        }
    }
}
