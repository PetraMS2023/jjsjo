<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends BaseModel
{
    use HasFactory;
    const IMAGEPATH = 'contacts' ;
    protected $fillable = ['name','email','phone','message','image','street','city'];


}
