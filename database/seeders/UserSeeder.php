<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        User::create([
            'name'=>'Norhan Taher',
            'email'=>'norhan@gmail.com',
            'password'=>bcrypt('123456'),
            'profile_img'=>'profile_img1.jpg'
        ]);
    }
}
