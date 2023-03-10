<?php

namespace Database\Seeders;

use App\Models\horarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class horarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $horario = [
        
        
        [
        "descripcion" => "TURNO #1",
        "start" => "08:00:00",
        "end" => "09:00:00",
        "status" =>"1",
        ],
        [ 
        "descripcion" => "TURNO #2",
        "start" => "09:30:00",
         "end" => "10:30:00",
        "status" =>"1",
       ],
       [ 
        "descripcion" => "TURNO #3",
        "start" => "11:00:00",
        "end" => "12:00:00",
        "status" =>"1",
        ],
        [ 
         "descripcion" => "TURNO #4",
         "start" => "12:30:00",
         "end" => "13:30:00",
         "status" =>"1",
            ],
            [ 
         "descripcion" => "TURNO #5",
         "start" => "14:00:00",
         "end" => "15:00:00",
         "status" =>"1",
                ],
                [ 
        "descripcion" => "TURNO #6",
        "start" => "15:30:00",
        "end" => "16:30:00",
        "status" =>"1",
                    ],

                    [ 
        "descripcion" => "TURNO #7",
        "start" => "17:00:00",
        "end" => "18:30:00",
        "status" =>"1",
                        ],
                        [ 
        "descripcion" => "TURNO #8",
        "start" => "19:00:00",
        "end" => "20:00:00",
        "status" =>"1",
                            ],];

        DB::table('horarios')->insert($horario);


    }
}
