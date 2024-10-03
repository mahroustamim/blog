<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['image', 'parent'];

    public function getParent()
    {
        // return $this->belongsTo(Category::class, 'parent')->where('parent', 0)->with('parent');
        return $this->belongsTo(Category::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent');
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
