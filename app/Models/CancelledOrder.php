<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class CancelledOrder extends Model
{
    use LogsActivity;
    protected $table = 'cancelorders';
    protected $primaryKey = 'cancelorder_id';
    protected $fillable = [
        'user_id','order_id','reason'
    ];
    public function users() {
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }
    public function orders() {
        
        return $this->hasMany('App\Models\Order','order_id','order_id');
    }
}
