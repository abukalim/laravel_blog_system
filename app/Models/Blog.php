<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Specify which attributes can be mass assigned
    protected $fillable = ['title', 'content', 'image', 'user_id'];

    // Define a relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class); // This references the user who created the blog
    }

    // Define a relationship to the Comment model
    public function comments()
    {
        return $this->hasMany(Comment::class); // A blog post can have many comments
    }

    // If you have any date fields, use the $casts property
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function author() {
        return $this->belongsTo(User::class);
    }
    
}

