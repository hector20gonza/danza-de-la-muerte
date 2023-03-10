<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horarios extends Model
{
    use HasFactory;
    protected $fillable = [ 'descripcion','start','end','status'];
    public function reserva()
    {
        return $this->belongsToMany(reserva::class,'id','users_id','horarios_id','status','fecha');
    }
}
