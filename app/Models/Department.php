<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kode_dokumen',
        'kode_bahan',
        'kode_jadi'

    ];

    protected $hidden = [

    ];
}
