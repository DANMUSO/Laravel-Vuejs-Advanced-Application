<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Purchaseorder extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'porder_id';
    protected $table = 'purchaseorders';
    protected static $recordEvents = ['created','updated'];
    protected $fillable = [
   'product_brand',
   'product_id',
   'quantity',
   'unit_price',
   'tax','total',
   'dop',
   'ordernumber'
    ];
    protected static $logName = 'Administrator';
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    public function products() {
        return $this->hasMany('App\Models\Product','product_id','product_id');
    }
    
}
