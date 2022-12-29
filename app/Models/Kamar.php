<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    public $guarded = ["id"];
    use HasFactory;
    protected $table='kamars';

    public function tipe(){
        return $this->belongsTo(TipeKamar::class,'id_tipe_kamar');
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_kamars', 'id_kamar', 'id_fasilitas');
    }
}
