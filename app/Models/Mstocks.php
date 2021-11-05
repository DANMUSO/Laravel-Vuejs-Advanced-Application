<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mstocks extends Model
{
    use HasFactory;
    protected $primaryKey='stocks_id';
    protected $table = 'stocks';
    protected $fillable = [
    'product_id',
    'order_id',
    'purchaseorder_id',
    'quantity',
    'stock_quantity'
    ];
    public function mproducts()
    {
        return $this->belongsTo('App\Models\Mproduct','product_id');
    }
}
