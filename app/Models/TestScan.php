<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestScan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik', 'name', 'dept', 'posisi', 'tagrfid',
    ];
}
