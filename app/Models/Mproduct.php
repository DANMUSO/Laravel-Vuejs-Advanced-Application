<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mproduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $table = 'products';
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
    
    public function mvendors() {
        return $this->belongsTo('App\Models\Mvendor','vendor_id','vendor_id');
    }
    public function mstocks(){
        return $this->hasMany('App\Models\Mstocks','product_id');
    }
}
