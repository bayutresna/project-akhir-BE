<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{

    public $guarded = ["id"];
    use HasFactory;
    protected $table='fasilitas';

    // public function kamar(){
    //     return $this->belongsToMany(Kamar::class, 'fasilitas_kamars', 'id_fasilitas', 'id_kamar');
    // }
}
