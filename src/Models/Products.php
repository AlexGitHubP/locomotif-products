<?php

namespace Locomotif\Products\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   public function categories(){
      return $this->belongsToMany('Locomotif\Products\Models\ProductsCategories', 'products_to_categories', 'product_id', 'category_id');
    }
    
    public function subcategories(){
      return $this->belongsToMany('Locomotif\Products\Models\ProductsSubcategories', 'products_to_subcategories', 'product_id', 'subcategory_id');
    }
    
    public function defaultCategory(){
      return $this->categories->first();
    }
}
