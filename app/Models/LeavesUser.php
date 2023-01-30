<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavesUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'name',
        'dept',
        'posisi',
        'leaves_type',
        'from_date',
        'to_date',
        'tagrfid',
        'leave_reason',
    ];
}
