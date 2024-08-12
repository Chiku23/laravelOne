<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory, Notifiable;

    // Specify the table name if different from the default
    protected $table = 'blogs';

    // Specify the primary key if different from the default
    protected $primaryKey = 'id';

    // Specify if the primary key is auto-incrementing
    public $incrementing = true;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id'); // Adjust based on your column names
    }
}
