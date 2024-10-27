<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image', // Assuming you have an image column
        'user_id', // If you are linking posts to users
    ];

    // Define any relationships, for example, if a post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
