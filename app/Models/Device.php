<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Device extends Model
{
    use LogsActivity;
    protected $table = "device_tokens";
    protected $primaryKey = 'device_id';
    protected $fillable =[
        'token',
        'user_id',
        'rider_id'
    ];
    protected static $logName = 'Device Token';
    
    protected static $logAttributes = [
        'token',
        'user_id',
        'rider_id'
            ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
}
