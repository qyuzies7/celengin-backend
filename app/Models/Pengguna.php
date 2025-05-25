<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = ['nama', 'email', 'password', 'terakhir_login'];

    protected $hidden = ['password'];
   
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pengguna_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengguna) {
            if ($pengguna->password && !str_starts_with($pengguna->password, '$2y$')) {
                $pengguna->password = bcrypt($pengguna->password);
            }
        });

        static::updating(function ($pengguna) {
            if ($pengguna->isDirty('password') && !str_starts_with($pengguna->password, '$2y$')) {
                $pengguna->password = bcrypt($pengguna->password);
            }
        });
    }
}