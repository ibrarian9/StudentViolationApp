<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    protected $table = 'tb_jenis_sanksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'jumlah_poin',
        'jenis_sanksi'
    ];
}
