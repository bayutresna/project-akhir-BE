<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasHotel extends Model
{
    public $guarded = ["id"];
    use HasFactory;
    protected $table='fasilitas_hotels';
}
