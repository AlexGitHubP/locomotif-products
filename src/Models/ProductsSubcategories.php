<?php

namespace Locomotif\Products\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsSubcategories extends Model
{
    public function category(){
        return $this->belongsTo('Locomotif\Products\Models\ProductsCategories', 'category_id');
    }
    
    public function products(){
        return $this->belongsToMany('Locomotif\Products\Models\Products', 'products_to_subcategories', 'subcategory_id', 'product_id');
    }
}
