<?php

namespace Locomotif\Products;

use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Locomotif\Products\Controller\ProductsController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/views',                              'products');
        $this->loadViewsFrom(__DIR__.'/views/categories',                   'categories');
        $this->loadViewsFrom(__DIR__.'/views/subcategories',                'subcategories');
        $this->loadViewsFrom(__DIR__.'/views/attributes',                   'attributes');
        $this->loadViewsFrom(__DIR__.'/views/areas',                        'areas');
        $this->loadViewsFrom(__DIR__.'/views/attributes/attributes_values', 'attributes_values');
        
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/locomotif/products'),
        ]);
        
    }
}
