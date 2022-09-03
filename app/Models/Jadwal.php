<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jadwalDokters()
    {
        return $this->belongsToMany(User::class, 'jadwal_dokter', 'jadwal_id', 'dokter_id')->withTimestamps();
    }
}
