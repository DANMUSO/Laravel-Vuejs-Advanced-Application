<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Orderdetail extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'order_details';
    protected $primaryKey = 'orderdetail_id';
    protected static $recordEvents = ['created','updated'];
    protected static $logName = 'Administrator';
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected static $logAttributes = [
    'orderdetail_id',
    'order_id',
    'product_id',
    'units_order',
    'total_price',
    'created_at'
        ];
    protected $fillable = [
    'orderdetail_id',
    'order_id',
    'product_id',
    'units_order',
    'total_price',
    'created_at'
    ];
    public function orders(){
        return $this->belongsTo('App\Models\Order');
    }
    public function products(){
        return $this->belongsTo('App\Models\Product','product_id', 'product_id');
    }
}
