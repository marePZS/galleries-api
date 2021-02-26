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

    public static function search($filter="") {
        return self::where("name || description", "LIKE", "%$filter%");
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
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
