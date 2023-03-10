<?php

use App\Http\Controllers\Api\Admin\AdministrarcitasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\logincontroller;
use App\Http\Controllers\API\horarioscontroller;

use App\Http\Controllers\API\reservacontroller;
use App\Http\Controllers\API\horariosdis;
use App\Http\Controllers\API\horiariodisponible;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\RoleController;
use Illuminate\Database\Console\ShowCommand;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

      Route::post('/login', logincontroller::class);
      
});
   
    
Route::middleware(['auth:sanctum'])->group(function () {

  Route::get('/horarios/{fecha}', [horarioscontroller::class,'horarioscheck']);
  Route::get('/reservas/{fecha}', [reservacontroller::class,'filtroadministrarallcitas']);
  Route::resource('/horarios', horarioscontroller::class);
  Route::resource('/reservas', reservacontroller::class);
 });

       
          Route::group(['middleware' => 'admin'], function (){ 
          Route::get('/horarios/{horario}', [horarioscontroller::class, 'horariosadmin']);
          Route::resource('/users', UserController::class);
          
         });
  
        
    
   
 

      
 