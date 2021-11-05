<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Product extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'product_id';
    protected $table = 'products';
    protected static $recordEvents = ['created','updated'];
    protected static $logName = 'Administrator';
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected static $logAttributes = [
        'refill_new', 
        'vendor_name',
        'product_brand',
        'product_size',
        'product_type',
        'unitprice',
        'selling_price',
        'reorder_level',
        'image',
        'product_name'
        ];
    protected $fillable= [
    'refill_new',
    'vendor_name',
    'product_brand',
    'product_size',
    'product_type',
    'unitprice',
    'selling_price',
    'reorder_level',
    'image',
    'product_name'
    ];
    
    public function orders() {
        return $this->belongsToMany('App\Models\Order')->withTimestamps();
    }
    public function vendors() {
        return $this->belongsTo('App\Models\Vendor','vendor_id','vendor_id');
    }
    public function getFullNameAttribute()
    {
    return $this->product_name . ' ' . $this->refill_new;
    }
    public function purchasedorder()
    {
        return $this->belongsTo('App\Models\Purchaseorder','product_id');
    }
}
