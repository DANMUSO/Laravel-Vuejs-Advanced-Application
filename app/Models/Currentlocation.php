<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Currentlocation extends Model
{
    use LogsActivity;
    protected $primaryKey = 'id';
    protected $table = 'rider_current_location';
    protected static $logName = 'CurrentLocation';
    
    protected static $logAttributes = [
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected $fillable= [
    'rider_id','lat','lng','distance','time'
    ];
    public function riders() {
        return $this->belongsTo('App\Models\Rider','rider_id','rider_id');
    }
    
}
