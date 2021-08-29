<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    protected $fillable = array('name_ar','name_en','categorie_id');
    protected $appends = ['name'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function getNameAttribute()
    {
        if(app()->getLocale() == 'ar') return $this->name_ar;
        if(app()->getLocale() == 'en') return $this->name_en;
    }

}