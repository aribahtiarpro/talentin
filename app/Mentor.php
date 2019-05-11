<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = [
        'id','user_id','no_ktp', 'pendidikan_terakhir', 'alasan_menjadi_mentor',
    ];
}
