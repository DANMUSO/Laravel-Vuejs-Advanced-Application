<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider_Availability extends Model
{
    use HasFactory;
    protected $table = "rider_availability";
    protected $fillable = [
    'rider_id',
    ];
    public function riders() {
        return $this->belongsTo('App\Models\Rider','rider_id','rider_id');
    }
}
