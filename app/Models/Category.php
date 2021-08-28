<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    //protected $table = 'categories';
    //public $timestamps = true;
    protected $fillable = array('name','parent_id');

    public function products()
    {
        return $this->hasMany('App\Product', 'category_id', 'id');
    }

    public function sub_categories()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

}