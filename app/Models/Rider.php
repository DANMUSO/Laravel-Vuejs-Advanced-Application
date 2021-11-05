<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Rider extends Authenticatable
{
    use LogsActivity;
    use HasApiTokens, Notifiable;
    protected $primaryKey = 'rider_id';
    protected $table = 'riders';
    protected static $logName = 'Rider';
    
    protected static $logAttributes = [
        'firstname','lastname','phone','email','platanumber','depot','status'
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected $fillable= [
    'firstname','lastname','phone','email','platanumber','depot','status'
    ];
    public function trips()
    {
        return $this->hasMany('App\Models\Trip','rider_id');
    }
    public function currentlocations()
    {
        return $this->hasMany('App\Models\Currentlocation','rider_id');
    }
    public function rider_availability()
    {
        return $this->hasMany('App\Models\Rider_Availability','rider_id');
    }
    
    public function orders()
    {
        return $this->belongToMany('App\Models\Order','rider_id');
    }
    public function assignedorders(){
        return $this->belongsTo('App\Models\AssignedOrder','rider_id','rider_id');
    }
    public function rates()
    {
        return $this->hasOne('App\Models\Rating','rider_id');
    }

}
