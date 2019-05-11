<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'classes';
    protected $fillable = [
        'nama','slug', 'img', 'video','harga','alamat_kursus','jml_jam','talent_id','mentor_id','deskripsi',
    ];
}
