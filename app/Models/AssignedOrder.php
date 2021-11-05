<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedOrder extends Model
{
    
    protected $fillable = [
    'order_id','rider_id'
    ];
    protected $table = "assigned_orders";

    public function orders() {
        
        return $this->hasMany('App\Models\Order','order_id','order_id');
    }
    public function riders() {
        
        return $this->hasMany('App\Models\Rider','rider_id','rider_id');
    }
}
