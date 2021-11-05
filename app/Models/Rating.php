<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Rating extends Model
{
    use LogsActivity;
    protected $primaryKey = 'rate_id';
    protected $table = 'rider_rates';
    protected static $logName = 'Rate';
    
    protected static $logAttributes = [
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected $fillable= [
    'rider_id','rates'
    ];
    public function riders() {
        return $this->belongsTo('App\Models\Rider','rider_id','rider_id');
    }
}
