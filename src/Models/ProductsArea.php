<?php

namespace Locomotif\Products\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsArea extends Model
{
    public function products(){
        return $this->belongsToMany('Locomotif\Products\Models\Products', 'products_to_areas');
    }
}
