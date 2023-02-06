<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavesUser extends Model
{
    use HasFactory;
    protected $table = 'leaves_admin';
    protected $fillable = [
        'user_id',
        'leave_type',
        'from_date',
        'to_date',
        'day',
        'data_status',
        'leave_reason',
    ];
}
