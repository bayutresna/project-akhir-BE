<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiNonKamar extends Model
{
    public $guarded = ["id"];
    use HasFactory;
    protected $table='reservasi_non_kamars';
}
