<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['email_jo','phone_jo','address_jo','address_en_jo','email_ps','phone_ps','address_ps','address_en_ps'] ;
    protected $table = 'addresses' ;
}
