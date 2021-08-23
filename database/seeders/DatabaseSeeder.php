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
        DB::table('users')->insert(['name'=>'hr alamin','email'=> 'hralamin2020@gmail.com', 'phone'=>'01254856954', 'type'=> 'admin',]);

//        DB::table('users')->insert(['name'=>'Lamiya', 'phone'=>'85406454165', 'type'=> 'customer',]);
//        DB::table('users')->insert(['name'=>'Taniya', 'phone'=>'65498498465', 'type'=> 'customer',]);
//        DB::table('users')->insert(['name'=>'dsaasd', 'phone'=>'40684846501', 'type'=> 'customer',]);
//        DB::table('users')->insert(['name'=>'qwertr', 'phone'=>'98749874066', 'type'=> 'customer',]);
//        DB::table('users')->insert(['name'=>'asryht', 'phone'=>'74085456665', 'type'=> 'customer',]);
//
//        DB::table('users')->insert(['name'=>'gggggg', 'phone'=>'45774454675', 'type'=> 'seller',]);
//        DB::table('users')->insert(['name'=>'ffffff', 'phone'=>'75654455645', 'type'=> 'seller',]);
//        DB::table('users')->insert(['name'=>'dddddd', 'phone'=>'68778785455', 'type'=> 'seller',]);
//        DB::table('users')->insert(['name'=>'ssssss', 'phone'=>'45646787854', 'type'=> 'seller',]);
//
//
//        DB::table('products')->insert(['name'=>'Deshi murgi']);
//        DB::table('products')->insert(['name'=>'cock murgi']);
//        DB::table('products')->insert(['name'=>'Farm murgi']);
//        DB::table('products')->insert(['name'=>'Paki murgi']);
//        DB::table('products')->insert(['name'=>'Turki murgi']);
//
//        DB::table('categories')->insert(['name'=>'12']);
//        DB::table('categories')->insert(['name'=>'13']);
//        DB::table('categories')->insert(['name'=>'14']);
//        DB::table('categories')->insert(['name'=>'15']);
//        DB::table('categories')->insert(['name'=>'16']);

        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\Purchase::factory(10)->create();
        \App\Models\Sell::factory(10)->create();
        \App\Models\Setup::factory(1)->create();
    }
}
