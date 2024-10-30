<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Text extends BaseModel
{
    use HasFactory ,  HasTranslations;
    const IMAGEPATH = 'videos' ;
    public $translatable = ['about_us' , 'conditions' , 'privacy_policy'] ;
    protected $fillable = ['about_us','conditions','privacy_policy' , 'image'] ;
}
