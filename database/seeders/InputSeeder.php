<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\DB;


class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      DB::table('speakers')->insert(['name'=>'suvisesh','email'=>'suvisesh@gmail.com','user_id'=>2]);
      DB::table('speakers')->insert(['name'=>'sam','email'=>'sam@gmail.com','user_id'=>3]);
      DB::table('organizers')->insert(['name'=>'raj','email'=>'raj@gmail.com','user_id'=>4]);
      DB::table('organizers')->insert(['name'=>'joe','email'=>'joe@gmail.com','user_id'=>5]);
      DB::table('attendees')->insert(['name'=>'prince','email'=>'prince@gmail.com','user_id'=>6]);
      DB::table('attendees')->insert(['name'=>'hari','email'=>'hari@gmail.com','user_id'=>7]);


      DB::table('countries')->insert(['name'=>'india']);
      DB::table('countries')->insert(['name'=>'USA']);
      DB::table('countries')->insert(['name'=>'UK']);

     DB::table('cities')->insert(['name'=>'channai','country_id'=>1]);
     DB::table('cities')->insert(['name'=>'Bengalure','country_id'=>1]);
     DB::table('cities')->insert(['name'=>'newyork','country_id'=>2]);
     DB::table('cities')->insert(['name'=>'califonia','country_id'=>2]);
     DB::table('cities')->insert(['name'=>'londan','country_id'=>3]);
     DB::table('cities')->insert(['name'=>'victoria','country_id'=>3]);

    }
}
