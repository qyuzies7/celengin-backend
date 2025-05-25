<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'pengguna_id', 'income_id', 'outcome_id', 'jenis', 'nominal', 'keterangan', 'tanggal'
    ];

    public $timestamps = true; 

    protected $casts = [
        'nominal' => 'encrypted',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function income()
    {
        return $this->belongsTo(Income::class, 'income_id');
    }

    public function outcome()
    {
        return $this->belongsTo(Outcome::class, 'outcome_id');
    }
}