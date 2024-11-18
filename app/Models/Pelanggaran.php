<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggaran extends Model
{
    protected $table = 'tb_pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'id_subkriteria'
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function subkriteria(): BelongsTo
    {
        return $this->belongsTo(Subkriteria::class, 'id_subkriteria', 'id_subkriteria');
    }
}
