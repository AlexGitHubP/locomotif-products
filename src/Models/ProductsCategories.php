<?php

namespace Locomotif\Products\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsCategories extends Model
{
    public function subcategories(){
        return $this->hasMany('Locomotif\Products\Models\ProductsSubcategories', 'category_id');
    }
    
    public function products(){
        return $this->belongsToMany('Locomotif\Products\Models\Products', 'products_to_categories', 'category_id', 'product_id');
    }
}
