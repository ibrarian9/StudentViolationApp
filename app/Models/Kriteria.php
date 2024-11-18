<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    protected $table = 'tb_kriteria';
    protected $primaryKey = 'id_kriteria';
    public $timestamps = false;

    protected $fillable = [
        'nama_kriteria',
        'bobot_kriteria'
    ];

    public function subkriteria(): HasMany
    {
        return $this->hasMany(Subkriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function getNormalisasiBobot($totalBobot): float
    {
        return $this->bobot_kriteria / $totalBobot;
    }
}
