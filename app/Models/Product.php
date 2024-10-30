<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

class Product extends BaseModel
{
    use HasFactory ,  HasTranslations;

    public $translatable = ['title' , 'description'] ;

    const IMAGEPATH = 'products' ;

    protected $fillable = ['title','description','image','category_id' , 'subcategory_id' ];

    // media
    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->orderBy('file_sort', 'asc');
    }

    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }

    // category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //subCategory subcategory_id table category
    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    protected static function booted()
    {
        parent::boot();
        Product::observe(ProductObserver::class);
    }
}
