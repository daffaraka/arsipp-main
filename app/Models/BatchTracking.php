<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchTracking extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'batch_id',
        'user_id',
        'keterangan',
        'status'
    ];

    public function batch()
    {
        return $this->belongsTo(BatchRecord::class,'batch_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
