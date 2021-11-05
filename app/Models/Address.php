<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Address extends Model
{
    use LogsActivity;
    protected $table = "locations";
    protected $primaryKey = 'location_id';
    protected $fillable =[
    'user_id',
    'address_url',
    'details',
    'instructions',
    'latitude',
    'longitude'
    ];
    protected static $logName = 'User';
    
    protected static $logAttributes = [
        'user_id',
        'address_url',
        'details',
        'instructions',
        'latitude',
        'longitude'
            ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    
}
