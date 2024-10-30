<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use UploadTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'image',
    ];
    protected $hidden = [
        'password',
    ];

    public function getAvatarAttribute() {
        if ($this->attributes['avatar']) {
            $image = $this->getImage($this->attributes['avatar'], 'admins');
        } else {
            $image = $this->defaultImage('admins');
        }
        return $image;
    }
    public function setAvatarAttribute($value) {
        if (null != $value && is_file($value) ) {
            isset($this->attributes['avatar']) ? $this->deleteFile($this->attributes['avatar'] , 'admins') : '';
            $this->attributes['avatar'] = $this->uploadAllTyps($value, 'admins');
        }
    }

    public function setPasswordAttribute($value) {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public static function boot() {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        static::deleted(function($model) {
            $model->deleteFile($model->attributes['avatar'], 'admins');
        });

    }
}
