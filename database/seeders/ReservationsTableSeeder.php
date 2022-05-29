<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            "firstname" => "Joe",
            "lastname" => "Doe",
            "email" => "joedoe@gmail.com",
            "phone" => "20.20.20",
            "arrival" => "2020-01-01",
            "weeknight" => 5,
            "weekendnight" => 2
        ]);
    }
}
