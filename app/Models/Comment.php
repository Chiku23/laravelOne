<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id'); // Adjust based on your column names
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id'); // Adjust based on your column names
    }
}
