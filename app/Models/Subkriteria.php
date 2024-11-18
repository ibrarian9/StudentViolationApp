<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subkriteria extends Model
{
    protected $table = 'tb_subkriteria';
    protected $primaryKey = 'id_subkriteria';
    public $timestamps = false;

    protected $fillable = [
        'id_kriteria',
        'nama_subkriteria',
        'bobot_subkriteria'
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function pelanggaran(): HasMany
    {
        return $this->hasMany(Pelanggaran::class, 'id_subkriteria', 'id_subkriteria');
    }
}
