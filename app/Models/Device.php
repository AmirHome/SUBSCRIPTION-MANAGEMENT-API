<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Device extends Model
{
    use HasApiTokens, HasFactory;

    public $table = 'devices';

    protected $fillable = [
        'u_id',
        'app_id',
        'lang',
        'os',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'id'
    ];
}
