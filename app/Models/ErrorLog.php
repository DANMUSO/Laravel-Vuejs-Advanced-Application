<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;
    protected $table = "errorlogs";
    protected $primaryKey='error_id';
    protected $fillable = [
        'error_file' , 
        'error_message' , 
        'error_line',
        'error_race' 
    ];
}
