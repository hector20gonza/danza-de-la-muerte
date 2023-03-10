<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;



class logincontroller extends Controller
{
    //

public function __invoke(Request $request)
{


    if (!auth()->attemp($request->only('email','password')))
    {
  throw new AuthenticactionException();

    }
}
public function register (Request $request){
    // validate request 
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->assignRole('usuario'); 
    $user->save();
    return $user;

}

public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
}




}
