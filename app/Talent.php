<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $fillable = [
        'id','nama','slug', 'img', 'deskripsi','index','created_at','updated_at'
    ];
}
