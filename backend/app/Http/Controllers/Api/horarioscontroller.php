<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\agendar;
use App\Models\reserva;
use App\Models\horarios;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class horarioscontroller extends Controller
{
 




   public function index(Request $request)
    {

        $now = carbon::now();
        $now = $now->toTimeString();

if ($now >='20:00:00') {
    return response([
        'message'=>'no puedes ver horarios a esta hora '
    ]);
}  else if($now <'20:00:00'){


        $datetime1 = Carbon::now();
         $datetime=  $datetime1->format('Y-m-d');

        $horariodis= DB::table('horarios')
          ->wherenotIn('id', function ($query) use ($datetime) {
              $query->select('horarios_id')
              ->from('reservas')
              ->where(function ($query) use ($datetime) {
                  $query->where(
                      'fecha',
                      $datetime
                  )->wherein('status', [1,3]);
              });
          })->get();

        return $horariodis;
           }   //--------------------------------------------------
    
}
   
   public function horariosadmin()
   {
      return Horarios::all();
   }




    
    
  
    public function store(Request $request)
    {



        
         $horario = new horarios();
         $horario->id=$request->id;
         $horario->descripcion=$request->descripcion;
         $horario->start=$request->start;
         $horario->end=$request->end;
         $horario->status='1';
         $horario->save();


    }

   
    public function update(Request $request)
    {
        $id = $request->input('id');
        $horario1 = horarios::find($id);
        $horario1->update($request->all());
       return  $horario1;
    }

    public function destroy(Request $request)
    {
       
        $horario3 = horarios::find($request->input('id'));
       
        $horario3->delete();

     return $horario3;
    }
    public function horarioscheck(Request $request){
    
            $now = carbon::now();
            $now = $now->toTimeString();
            $fecha= $request->input('fecha');
            if ($now >='20:00:00') 
              {
                return response([
                   'message'=>'no puedes ver horarios a esta hora ' ]);
                                 
              } 
            else if($now <'20:00:00')
              {
                 
                  $horario1=DB::table('horarios')
                  ->wherenotIn('id', function ($query) use ($fecha) {
                  $query->select('horarios_id')
                  ->from('reservas')
                  ->where(function ($query) use ($fecha) {
                  $query->where('fecha', $fecha)
                  ->whereIn('status', [1,3]);
                   });
                  })->get();

                   return $horario1;
            } 
}
    
}
