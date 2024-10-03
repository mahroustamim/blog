<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['title', 'content', 'small_desc', 'tags'];
    protected $fillable = ['category_id', 'image', 'user_id', 'visits', 'visitors'];

    public function category() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
