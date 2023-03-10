<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reserva;

class AdministrarcitasController extends Controller
{
    
 public function index(){

return reserva::all();

 }




}
