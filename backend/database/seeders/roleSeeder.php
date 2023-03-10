<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        
        
            [
            "name" => "Admin",
           
            ],
            [ 
            "name" => "usuario",
        
           ]
           ];
    
            DB::table('roles')->insert($roles);
    
    }
}
