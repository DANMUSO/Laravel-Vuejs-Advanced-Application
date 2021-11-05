<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Notification extends Model
{
    //
    use LogsActivity;
    protected $table = 'notifications';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'notification_id','order_id','orderstatus','title','description'
    ];
    
    protected static $logName = 'User';
    protected static $logAttributes = [
        'notification_id','order_id','orderstatus','title','description'
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    
    public function orders(){
        return $this->belongsTo('App\Models\Notification');
    }
}
