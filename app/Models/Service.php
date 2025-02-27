<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = ['name', 'desc'];
    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'service');
    }

   
}
