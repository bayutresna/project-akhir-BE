<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public $guarded = ["id"];
    use HasFactory;
    protected $table='users';

    use HasApiTokens, HasFactory, Notifiable;




    protected static function boot()
    {
        parent::boot();
        // otomatis hash password waktu create user
        static::creating (function(user $user){
            $user->password = Hash::make($user->password);
        });

        //untuk update jika ada perubahan pada password biar dihash dulu
        static::updating (function(user $user){
            if($user->isDirty(['password'])){
                $user->password = hash::make($user->password);
            }
        });
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
       return $this->belongsTo(roles::class, 'id_role');
    }
}
