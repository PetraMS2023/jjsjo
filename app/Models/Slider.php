<?php

namespace App\Models;

use App\Observers\SliderObserver;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slider extends Model
{
    use HasFactory , UploadTrait;
    protected $fillable = [
        'title',
        'image',
        'video',
        'link',
        'type',
    ];

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'sliders');
        } else {
            $image = $this->defaultImage('sliders');
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'sliders') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'sliders');
        }
    }

    public function getVideoAttribute()
    {
        if ($this->attributes['video']) {
            $video = $this->getImage($this->attributes['video'], 'sliders');
        } else {
            $video = $this->defaultImage('sliders');
        }
        return $video;
    }

    public function setVideoAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['video']) ? $this->deleteFile($this->attributes['video'], 'sliders') : '';
            $this->attributes['video'] = $this->uploadAllTyps($value, 'sliders');
        }
    }

    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->orderBy('file_sort', 'asc');
    }

    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }

    public function delete()
    {
        $this->deleteFile($this->attributes['image'], 'sliders');
        $this->deleteFile($this->attributes['video'], 'sliders');
        parent::delete();
    }


/*    protected static function booted()
    {
        parent::boot();
        Slider::observe(SliderObserver::class);
    }*/
}
