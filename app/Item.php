<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /*
    |-----------------------------------------
    | Item model
    |-----------------------------------------
    |
    | 
    | Author : Juman
    | Version : 1.0.0
    |
    */
    public function getCategory(){
        return $this->belongsTo(\App\Category::class, 'item_cat_id', 'id');
    }

    public function getAllergies(){
        return $this->belongsToMany(\App\Allergy::class, 'item_allergies');
    }
    
    public function getVariances(){
        // return $this->belongsToMany(\App\Variance::class, 'item_variances');
        return $this->belongsToMany(\App\Variance::class, 'item_variances')->withPivot('item_new_price','item_old_price');

    }
}
