<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    public $guarded = ["id"];
    use HasFactory;
    protected $table='tipe_kamars';

    public function kamars (){
        return $this->hasMany(Kamar::class, 'id_tipe_kamar');
    }
}
