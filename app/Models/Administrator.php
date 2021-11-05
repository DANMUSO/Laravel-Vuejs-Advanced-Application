<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
class Administrator extends Authenticatable
{
    use  HasApiTokens, Notifiable,HasFactory, LogsActivity;

    protected $guard = 'administrator';
    protected static $logName = 'Administrator';
    
    protected static $logAttributes = [
        'firstname',
        'lastname',
        'phone',
        'email', 
        'password',
            ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email', 
        'password',
    ];
  
}
