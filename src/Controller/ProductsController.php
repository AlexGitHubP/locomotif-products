<?php

namespace Locomotif\Products\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Locomotif\Products\Models\Products;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authgate');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        
        return view('products::list')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('products::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function setOrder($product_id){

    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $product = new Products();

        $product->name              = $request->name;
        $product->url               = $request->url;
        $product->designer_id       = $request->designer_id;
        $product->product_type      = $request->product_type;
        $product->sku               = $request->sku;
        $product->stock             = $request->stock;
        $product->price             = $request->price;
        $product->price_estimate    = $request->price_estimate;
        $product->description       = $request->description;
        $product->technical_specs   = $request->technical_specs;
        $product->technical_file    = $request->technical_file;
        $product->product_area      = $request->product_area;
        $product->rand_3d           = $request->rand_3d;
        $product->favourite_product = $request->favourite_product;
        $product->product_status    = $request->product_status;
        
        $product->save();

        return redirect('admin/products/'.$product->id.'/edit');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('products::show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('products::edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $product->name              = $request->name;
        $product->url               = $request->url;
        $product->designer_id       = $request->designer_id;
        $product->product_type      = $request->product_type;
        $product->sku               = $request->sku;
        $product->stock             = $request->stock;
        $product->price             = $request->price;
        $product->price_estimate    = $request->price_estimate;
        $product->description       = $request->description;
        $product->technical_specs   = $request->technical_specs;
        $product->technical_file    = $request->technical_file;
        $product->product_area      = $request->product_area;
        $product->rand_3d           = $request->rand_3d;
        $product->favourite_product = $request->favourite_product;
        $product->product_status    = $request->product_status;
        $product->save();

        return redirect('admin/products/'.$product->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect('/admin/products');
    }
}
