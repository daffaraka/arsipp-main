<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'bets_no',
        'bets_date',
        'bets_received',
        'kode',
        'department_id',
        'sender_id',
        'bets_file',
    ];

    protected $hidden = [

    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id','id');
    }
}
