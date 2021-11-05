<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LiteProgressBarTrait;
use Spatie\Activitylog\Traits\LogsActivity;
class Order extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected static $recordEvents = ['created','updated'];
    protected static $logName = 'Administrator';
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected static $logAttributes = [
        'order_id',
        'user_id',
        'location_id',
        'totalprice',
        'paymentmethod',
        'orderstatus',
        'created_at'
            ];
    protected $fillable = [
  
        'user_id','location_id','orderstatus','totalprice','deliveryDate','delivery_time','created_at','updated_at'
    
    ];

    public function users() {
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }
    public function locations() {
        return $this->belongsTo('App\Models\Location','location_id','location_id');
    }
    public function orderdetails() {
        return $this->belongsToMany('App\Models\Product','App\Models\Orderdetail','order_id','product_id');
    }
    public function product_details(){
        return $this->hasMany('App\Models\Orderdetail','order_id');
    }
    public function loyalpoints(){
        return $this->belongsTo('App\Models\Loyalpoint','order_id','order_id');
    }
    public function cancelledorders(){
        return $this->belongsTo('App\Models\CancelledOrder','order_id','order_id');
    }
    public function assignedorders(){
        return $this->belongsTo('App\Models\AssignedOrder','order_id','order_id');
    }
    public function trips()
    {
        return $this->hasOne('App\Models\Trip','order_id');
    }
    public function payments()
    {
        return $this->hasOne('App\Models\Payments','order_id');
    }
   
}
