<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class User extends Model
{
    use HasApiTokens, Notifiable, LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';
    protected $table = "users";
    protected static $recordEvents = ['created','updated'];
    protected static $logAttributes = [
        'firstname', 
        'lastname',
        'phone',
        'email',
        ];
    protected $fillable = [
        'firstname',
        'lastname',
        'phone', 
        'email',
        'created'
    ];
    protected static $logName = 'User';
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    public function orders() {
        return $this->hasMany('App\Models\Order','user_id');
    }
    public function loyalpoints() {
        return $this->hasMany('App\Models\Loyalpoint','user_id');
    }
    
    public function locations()
    {
        return $this->hasMany('App\Models\Location','user_id');
    }
    public function orderdetails() {
        return $this->hasManyThrough(
            'App\Models\Orderdetail',
            'App\Models\Order',
            'user_id',   // Foreign key on orders table...
            'order_id',  // Foreign key on orderdetails table...
            'user_id',   // Local key on users table...
            'order_id'  // Local key on orders table...
                     );
    }
 
}
