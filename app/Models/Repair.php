<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $table="repair";
    protected $fillable = [
        'printer_id',
        'amount',
        'issue',
        'repair',
        
    ];
}
