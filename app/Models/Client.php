<?php

namespace App\Models;

use App\Observers\ClientObserver;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

class Client extends Model
{
    use HasFactory , UploadTrait , HasTranslations ;

    protected $fillable = [
        'name',
        'image',
        'job_title',
    ];

    public $translatable = ['name' , 'job_title'];


    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'clients');
        } else {
            $image = $this->defaultImage('clients');
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'clients') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'clients');
        }
    }

    // media
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
        $this->deleteFile($this->attributes['image'], 'clients');
        parent::delete();
    }


    protected static function booted()
    {
        parent::boot();
        Client::observe(ClientObserver::class);
    }

}
