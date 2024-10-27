<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'author_id'];

    // Define a relationship to the User model (assuming your User model has a relationship)
    public function author()
    {
        return $this->belongsTo(User::class); // Adjust this if your author model is different
    }
}

