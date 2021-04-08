<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public $table = 'subscription';

    protected $fillable = [
        'device_id',
        'receipt',
        'status',
        'expire_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'id'
    ];

    public function device(){
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }
}
