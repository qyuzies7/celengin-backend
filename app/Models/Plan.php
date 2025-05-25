<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';
    protected $fillable = [
        'pengguna_id',
        'periode_type',
        'periode_start',
        'periode_end',
        'nominal',
    ];
    protected $casts = [
        'nominal' => 'encrypted',
    ];
    
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}