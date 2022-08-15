<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    protected $appends = [
        'path'
    ];

    public function path() : Attribute 
    {
        return new Attribute(fn () => route('posts.show', $this));
    }

    public function title() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    public function description() : Attribute 
    {
        return new Attribute(
            fn ($value) => ucfirst($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id');
    }
}
