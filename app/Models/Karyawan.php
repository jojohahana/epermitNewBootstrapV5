<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'dept',
        'posisi',
        'leaves_type',
        'from_date',
        'to_date',
        'leave_reason',
    ];
}
