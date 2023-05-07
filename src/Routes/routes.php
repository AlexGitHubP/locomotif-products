<?php

Route::group(['middleware'=>'web'], function(){
	Route::resource('/admin/products', 'Locomotif\Products\Controller\ProductsController');
	Route::resource('/admin/productsCategories', 'Locomotif\Products\Controller\ProductsCategoriesController');
	Route::resource('/admin/productsSubcategories', 'Locomotif\Products\Controller\productsSubcategoriesController');
	Route::resource('/admin/productsAttributes', 'Locomotif\Products\Controller\ProductsAttributesController');
	Route::resource('/admin/productsAttributesValues', 'Locomotif\Products\Controller\ProductsAttributesValuesController');
	Route::resource('/admin/productsArea', 'Locomotif\Products\Controller\ProductsAreaController');
	Route::resource('/admin/productsMeta', 'Locomotif\Products\Controller\ProductsMetaController');

	Route::POST('/admin/productsAttributesValues/getAssocValues', 'Locomotif\Products\Controller\ProductsAttributesValuesController@getAssocValues');
	Route::POST('/admin/productsAttributesValues/ajaxDelete', 'Locomotif\Products\Controller\ProductsAttributesValuesController@ajaxDelete');
	Route::POST('/admin/productsAttributesValues/getGroupedAssocValues', 'Locomotif\Products\Controller\ProductsAttributesValuesController@getGroupedAssocValues');
	Route::POST('/admin/productsMeta/ajaxDelete', 'Locomotif\Products\Controller\ProductsMetaController@ajaxDelete');
	Route::POST('/admin/productsMeta/storeAjax', 'Locomotif\Products\Controller\ProductsMetaController@storeAjax');
	Route::POST('/admin/productsMeta/checkMetaExists', 'Locomotif\Products\Controller\ProductsMetaController@checkMetaExists');
	Route::POST('/admin/productsCategories/addCategoriesAndSubcategories', 'Locomotif\Products\Controller\ProductsCategoriesController@addCategoriesAndSubcategories');
	Route::POST('/admin/productsArea/addAreasToProducts', 'Locomotif\Products\Controller\ProductsAreaController@addAreasToProducts');
	
	
});
