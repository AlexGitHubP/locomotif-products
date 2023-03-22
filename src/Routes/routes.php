<?php

Route::group(['middleware'=>'web'], function(){
	Route::resource('/admin/products', 'Locomotif\Products\Controller\ProductsController');
	Route::resource('/admin/productsAttributes', 'Locomotif\Products\Controller\ProductsAttributesController');
});
