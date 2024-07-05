<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterUser extends Model
{
    use HasFactory;
    protected $table="printer_user";
    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'company_id'
    ];
}
