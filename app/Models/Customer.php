<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    // Specify the table name if different from the default
    protected $table = 'customers';

    // Specify the primary key if different from the default
    protected $primaryKey = 'cust_id';

    // Specify if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data types for the primary key
    protected $keyType = 'int';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'fullname', 'email', 'password', 'number', 'address', 'isAdmin',
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isAdmin' => 'boolean',
    ];
}
