<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\reserva;
use App\Models\horarios;
use App\Models\users;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;

class reservacontroller extends controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(Request $request)  {
        $id= $request->input('users_id');
        $users = DB::table('reservas')
        ->join('users', 'reservas.users_id', '=', 'users.id')
        ->join('horarios', 'horarios.id', '=', 'reservas.horarios_id')->where('users.id','=', $id)
        ->select('users.name', 'reservas.fecha','horarios.descripcion','reservas.status')
        ->get();
        return  $users;

    }

  
    public function store(Request $request)
    {   
             $fec= $request->fecha;
             $id_us=$request->users_id;
             $existen=DB::table('reservas')
             ->where('fecha',$fec)
             ->where('users_id',$id_us)
             ->select('users_id')
             ->first();
             $value1 = $existen?->users_id;

       if ($id_us == $value1) {
        return response([
            'message'=>'Solo puedes tomar un turno por dia '
        ]);
       
       }else{
        $reserva1 = new reserva();
        $reserva1->users_id=$request->users_id;;
        $reserva1->horarios_id= $request->hora_id;
        $reserva1->status=$request->status;
        $reserva1->fecha=$request->fecha;
        $reserva1->save();
         return response([
              'message'=>'Has Registrado tu cita de forma exitosa.... '
          ]);
        }
     

    }
 
   

    public function filtroadministrarallcitas(Request $request)
    {
          $fecha=$request->input('fecha');
          $consulta=DB::table('reservas')
          ->join('users', 'reservas.users_id', '=', 'users.id')
          ->join('horarios', 'horarios.id', '=', 'reservas.horarios_id')
          ->where('reservas.fecha',$fecha)
          ->select('users.name', 'reservas.fecha','horarios.descripcion','reservas.id','reservas.status')->get();
          return $consulta;

 //  SELECT h.username, r.fecha, t.descripcion from reservas r INNER JOIN users h on  h.id=r.users_id  INNER join horarios  t on  t.id=r.horarios_id where h.id='1'
    }
    public function show( $id)
    {
        $id= $id->input('users_id');
        $users = DB::table('reservas')
        ->join('users', 'reservas.users_id', '=', 'users.id')
        ->join('horarios', 'horarios.id', '=', 'reservas.horarios_id')->where('users.id','=', $id)
        ->select('users.name', 'reservas.fecha','horarios.descripcion')
        ->get();
        return  $users;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        $id = $request->input('id');
        $horario1 = reserva::find($id);
        $horario1->status =3;
        $horario1->save();
       return  $horario1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
}
