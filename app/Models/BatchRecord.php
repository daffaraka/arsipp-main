<?php

namespace App\Models;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'bets_no',
        'bets_date',
        'kode',
        'produk_id',
        'sender_id',
    ];




    public function department()
    {
        return $this->belongsTo(Department::class, 'produk_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id','id');
    }

    public function tracking()
    {
        return $this->hasMany(BatchTracking::class,'batch_id')->latest();
    }
}
