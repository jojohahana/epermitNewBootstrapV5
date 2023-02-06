<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'leaves_admins';
    protected $fillable = [
        'user_id',
        'leaves_type',
        'from_date',
        'to_date',
        'day',
        'leave_reason',
        'data_status',
    ];
}
