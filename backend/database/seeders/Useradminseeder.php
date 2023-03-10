<?php

namespace Database\Seeders;

use App\Models\roles;
use App\Models\User;
use Illuminate\Database\Seeder;



class Useradminseeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       
            $contraseña = "Adminmuerte";
            $user = new User([
              
                "name" => "Admin",
                "username" => "Muerte",
                "email" => "admin@gmail.com",
                "password" =>bcrypt($contraseña),
                "is_admin"=>true,
            ]);
        
         

   
  
        $user->saveOrFail();
           
        
        }



    
}
