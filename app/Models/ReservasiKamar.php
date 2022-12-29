<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiKamar extends Model
{
    public $guarded = ["id"];
    use HasFactory;
    protected $table='reservasi_kamars';

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function kamar(){
        return $this->belongsTo(Kamar::class,'id_kamar');
    }
}
