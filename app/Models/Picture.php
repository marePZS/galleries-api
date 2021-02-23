<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageUrl',
        'gallery_id'
    ];

    public function user()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'gallery_id');
    }
}
