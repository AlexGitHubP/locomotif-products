<?php

namespace Locomotif\Products\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Locomotif\Products\Models\ProductsAttributes;
use Carbon\Carbon;

class ProductsAttributesController extends Controller
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
        $productsAttributes = ProductsAttributes::all();
        
        return view('attributes::list')->with('productsAttributes', $productsAttributes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attributes::create');
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
            'attr_name'       => 'required',
            'attr_identifier' => 'required',
        ]);

        $productAttribute = new ProductsAttributes();

        $productAttribute->attr_name        = $request->attr_name;
        $productAttribute->attr_identifier  = $request->attr_identifier;
        $productAttribute->attr_descr       = $request->attr_descr;
        $productAttribute->attr_status      = $request->attr_status;
        
        
        $productAttribute->save();

        return redirect('admin/productsAttributes/'.$productAttribute->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsAttributes  $productsAttributes
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsAttributes $productsAttributes)
    {
        return view('attributes::show')->with('productsAttributes', $productsAttributes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsAttributes  $productsAttributes
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsAttributes $productsAttribute)
    {
        return view('attributes::edit')->with('productsAttributes', $productsAttribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsAttributes  $productsAttributes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsAttributes $productsAttribute)
    {
        $currentTime = Carbon::now()->timezone('Europe/Bucharest')->format('y-m-d H:i:s');
        $productsAttribute->attr_name = $request->attr_name;
        $productsAttribute->attr_identifier = $request->attr_identifier;
        $productsAttribute->attr_descr = $request->attr_descr;
        $productsAttribute->updated_at = $currentTime;
        $productsAttribute->attr_status = $request->attr_status;
        
        $productsAttribute->save();

        return redirect('admin/productsAttributes/'.$productsAttribute->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsAttributes  $productsAttributes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsAttributes $productsAttributes)
    {
        $productsAttributes->delete();
        return redirect('/admin/productsAttributes');
    }
}
