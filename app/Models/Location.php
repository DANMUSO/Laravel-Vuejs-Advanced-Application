<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Location extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'locations';
    //protected static $recordEvents = ['created','updated'];
    protected static $logName = 'Administrator';
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected static $logAttributes = [
    'id',
    'lat',
    'lng',
    'name'
            ];
    protected $fillable = [
        'id',
        'lat',
        'lng',
        'name'
    ];
    public function orders() {
        return $this->hasMany('App\Models\Models\Order','location_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }
}
