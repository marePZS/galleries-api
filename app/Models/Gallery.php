<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'author',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'gallery_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'gallery_id');
    }
}