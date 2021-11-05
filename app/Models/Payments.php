<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table='payments'; 
    protected $primaryKey = 'payment_id';

    public function orders()
    {
        return $this->belongsTo('App\Models\Order','order_id');
    }
}
