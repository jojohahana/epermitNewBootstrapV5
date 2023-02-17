<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaves_admins extends Model
{
    use HasFactory;
    protected $table = 'leaves_admin';
    protected $fillable = [
        'user_id',
        'name',
        'leave_type',
        'from_date',
        'to_date',
        'day',
        'data_status',
        'leave_reason',
        'stat_app1',
        'stat_app2',
        'stat_app3',
    ];
}
