<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'hr alamin',
            'email'=>'hralamin2020@gmail.com',
            'type'=> 'admin',
            'phone'=> '61065051',
            'profile_photo_path' => 'https://via.placeholder.com/640x480.png/00ddff?text=Admin',
            'password'=>Hash::make('000000')
        ]);
//        \App\Models\User::factory(10)->create();
//        \App\Models\Category::factory(10)->create();
//        \App\Models\Product::factory(10)->create();
//        \App\Models\Purchase::factory(10)->create();
//        \App\Models\Sell::factory(10)->create();
        \App\Models\Setup::factory(1)->create();
    }
}
