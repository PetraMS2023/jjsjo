<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory , UploadTrait , HasTranslations ;
    public $translatable = ['description' , 'title' ];


    protected $fillable = [
        'title', 
        'description',
        'image',
        'date',
    ];

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'news');
        } else {
            $image = $this->defaultImage('news');
        }
        return $image;
    }
    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'news') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'news');
        }
    }

    public function delete()
    {
        $this->deleteFile($this->attributes['image'], 'news');
        parent::delete();
    }
}
