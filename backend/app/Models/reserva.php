<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    protected $fillable = [ 'users_id','horarios_id','status','fecha'];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function horarios()
    {
        return $this->belongsToMany(horarios::class,'id','start','end');
    }
}
