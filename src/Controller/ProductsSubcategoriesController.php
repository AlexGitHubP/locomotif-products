<?php

namespace Locomotif\Products\Controller;

use Locomotif\Media\Controller\MediaController;
use Locomotif\Products\Models\ProductsSubcategories;
use Locomotif\Products\Models\ProductsCategories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class ProductsSubcategoriesController extends Controller
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
        
        $productsSubcategories = ProductsSubcategories::with('category')->get();
        return view('subcategories::list')->with('productsSubcategories', $productsSubcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = ProductsCategories::all();
        return view('subcategories::create')->with('parentCategories', $parentCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required',
            'subcategory_url'  => 'required',
            'subcategory_status'  => 'required',
            'subcategory_description'  => 'required',
            
            'category_id'  => 'required'
        ]);

        $productSubcategory = new ProductsSubcategories();

        
        $productSubcategory->category_id             = $request->category_id;
        $productSubcategory->subcategory_name        = $request->subcategory_name;
        $productSubcategory->subcategory_url         = $request->subcategory_url;
        $productSubcategory->subcategory_description = $request->subcategory_description;
        $productSubcategory->subcategory_status      = $request->subcategory_status;
        
        
        $productSubcategory->save();

        return redirect('admin/productsSubcategories/'.$productSubcategory->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsSubcategories  $productsSubcategories
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsSubcategories $productsSubcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsSubcategories  $productsSubcategories
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsSubcategories $productsSubcategory)
    {
        
        $productsSubcategory = ProductsSubcategories::with('category')->where('id', $productsSubcategory->id)->first();
        $parentCategories = ProductsCategories::all();
        $associatedMedia      = app(MediaController::class)->mediaAssociations($productsSubcategory->getTable(), $productsSubcategory->id);
        
        return view('subcategories::edit')->with('productSubcategory', $productsSubcategory)->with('parentCategories', $parentCategories)->with('associatedMedia', $associatedMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsSubcategories  $productsSubcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsSubcategories $productsSubcategory)
    {
        $request->validate([
            'subcategory_status' => 'required',
            'category_id' => 'required',
        ]);

        $productsSubcategory->subcategory_name        = $request->subcategory_name;
        $productsSubcategory->subcategory_url         = $request->subcategory_url;
        $productsSubcategory->category_id             = $request->category_id;
        $productsSubcategory->subcategory_description = $request->subcategory_description;
        $productsSubcategory->subcategory_status      = $request->subcategory_status;
        $productsSubcategory->save();

        return redirect('admin/productsSubcategories/'.$productsSubcategory->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsSubcategories  $productsSubcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsSubcategories $productsSubcategory)
    {
        $productsSubcategory->delete();
        return redirect('/admin/productsSubcategories');
    }
}
