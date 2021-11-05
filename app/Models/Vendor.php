<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Vendor extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'vendor_id';
    protected $table = 'vendors';
    protected static $recordEvents = ['created','updated'];
    protected static $logName = 'Administrator';
    protected static $logAttributes = [
        'vendor_name', 
        'vendor_address',
        'phone',
        'person',
        'email',
        'doc',
        'image'];
    protected $fillable = [
        'vendor_name',
        'vendor_address',
        'phone',
        'email',
        'person',
        'image',
        'doc',
        'oldfile',
        'status'
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This record has been {$eventName}";
    }
    public function products(){

        return $this->hasMany('App\product', 'vendor_id');

    }
}
