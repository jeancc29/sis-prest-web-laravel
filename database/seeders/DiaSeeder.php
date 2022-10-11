<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dia::updateOrCreate(["dia" => "Lunes", "weekday" => 1]);
        Dia::updateOrCreate(["dia" => "Martes", "weekday" => 2]);
        Dia::updateOrCreate(["dia" => "Miercoles", "weekday" => 3]);
        Dia::updateOrCreate(["dia" => "Jueves", "weekday" => 4]);
        Dia::updateOrCreate(["dia" => "Viernes", "weekday" => 5]);
        Dia::updateOrCreate(["dia" => "Sabado", "weekday" => 6]);
        Dia::updateOrCreate(["dia" => "Domingo", "weekday" => 0]);
    }
}
