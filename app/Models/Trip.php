<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Rider;
class Trip extends Model
{
    use LogsActivity;
    protected $primaryKey = 'trip_id';
    protected $table = 'trips';
    protected static $logName = 'Trip';
    
    protected static $logAttributes = [
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected $fillable= [
    'order_id','rider_id','start_time','end_time'
    ];
    public function riders() {
        return $this->belongsTo('App\Models\Rider','rider_id','rider_id');
    }
    public function orders() {
        return $this->hasOne('App\Models\Order','order_id','order_id');
    }
    public function locations() {
        return $this->belongsToMany('App\Models\Address','App\Models\Order','order_id','location_id');
    }
}
