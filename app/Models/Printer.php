<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;
    protected $table="printer_map";

    protected $fillable = [
        'company_id',
        'printer_name',
        'printer_user_id',
        'department_id',
        'printer_type_id',
        'printer_brand_id',
        'comment',
        'serial_number',
    ];
}
