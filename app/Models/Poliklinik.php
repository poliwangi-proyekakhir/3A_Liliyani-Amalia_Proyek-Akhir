<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function poliklinikJadwals()
    {
        return $this->belongsToMany(User::class, 'jadwal_dokter', 'poliklinik_id', 'jadwal_id')->withTimestamps();
    }
}
