<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mvendor extends Model
{
    use HasFactory;
    protected $primaryKey = 'vendor_id';
    protected $table = 'vendors';
    protected $fillable = [
        'vendor_name',
        'vendor_address',
        'phone',
        'email',
        'person',
        'image',
        'doc',
        'oldfile'
    ];
    public function mproducts(){
        return $this->hasMany('App\Models\Mproduct', 'vendor_id');
    }
    
    
}
