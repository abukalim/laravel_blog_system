<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Make sure to include 'user_id' instead of 'author_id'
    protected $fillable = ['title', 'content', 'image', 'user_id'];

    // Define a relationship to the User model
    public function author()
    {
        return $this->belongsTo(User::class); // Adjust this if your author model is different
    }
}
