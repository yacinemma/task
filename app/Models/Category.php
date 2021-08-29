<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
    protected $fillable = array('name_ar','name_en','parent_id');
    protected $appends = ['name'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function sub_categories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public function getNameAttribute()
    {
        if(app()->getLocale() == 'ar') return $this->name_ar;
        if(app()->getLocale() == 'en') return $this->name_en;
    }

}