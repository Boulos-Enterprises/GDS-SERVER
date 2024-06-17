<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $table="maintenance";

    protected $fillable = [
        'printer_id',
        'maintenance',
        'maintenance_type_id',
    ];
}
