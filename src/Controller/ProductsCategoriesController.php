<?php

namespace Locomotif\Products\Controller;

use Locomotif\Products\Models\ProductsCategories;
use Locomotif\Media\Controller\MediaController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsCategoriesController extends Controller
{
    public function __construct()
    {   
        $this->middleware(['authgate:administrator']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsCategories = ProductsCategories::all();
        return view('categories::list')->with('productsCategories', $productsCategories);
    }

    public function getCategAndSubcateg($product_id){

        $categories = ProductsCategories::with('subcategories')->get();
        
        foreach ($categories as $key => $category) {
            $categories[$key]->selected = DB::table('products_to_categories')->where([
                ['product_id',  '=', $product_id],
                ['category_id', '=', $category->id]
            ])->exists();
            foreach ($category->subcategories as $kk => $subcategory) {
                $category->subcategories[$kk]->selected = DB::table('products_to_subcategories')->where([
                    ['product_id',  '=', $product_id],
                    ['subcategory_id', '=', $subcategory->id]
                ])->exists();
            }
        }
        

        return view('categories::categoriesAndSubcategories')->with('product_id', $product_id)->with('categories', $categories);
    }

    public function insertCategoryToProduct($request){
        DB::table('products_to_categories')->where([
            ['product_id',  '=', $request->pid]
        ])->delete();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($request->categories as $key => $value) {
            DB::table('products_to_categories')->insert([
                'product_id'  => $request->pid,
                'category_id' => $value,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }
    public function clearAllCategories($request){
        DB::table('products_to_categories')->where([
            ['product_id',  '=', $request->pid]
        ])->delete();
    }

    public function insertSubcategoriesToProduct($request){
        DB::table('products_to_subcategories')->where([
            ['product_id',  '=', $request->pid]
        ])->delete();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($request->subcategories as $key => $value) {
            DB::table('products_to_subcategories')->insert([
                'product_id'     => $request->pid,
                'subcategory_id' => $value,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }
    }

    public function clearAllSubcategories($request){
        DB::table('products_to_subcategories')->where([
            ['product_id',  '=', $request->pid]
        ])->delete();
    }


    public function addCategoriesAndSubcategories(Request $request){
        
        if(isset($request->categories) && count($request->categories) !=0){
            $this->insertCategoryToProduct($request);
        }else{
            $this->clearAllCategories($request);
        }

        if(isset($request->subcategories) && count($request->subcategories) !=0){
            $this->insertSubcategoriesToProduct($request);
        }else{
            $this->clearAllSubcategories($request);
        }

        $response['success'] = true;
        $response['message'] = 'Asocieri cu succes.';
        $response['type'] = 'category';

        return response()->json($response);
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories::create');
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
            'category_name' => 'required',
            'category_url'  => 'required',
        ]);

        $productCategory = new ProductsCategories();

        $productCategory->category_name        = $request->category_name;
        $productCategory->category_url         = $request->category_url;
        $productCategory->category_description = $request->category_description;
        $productCategory->category_status      = $request->category_status;
        
        
        $productCategory->save();

        return redirect('admin/productsCategories/'.$productCategory->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsCategories $productsCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsCategories $productsCategory)
    {
        $associatedMedia      = app(MediaController::class)->mediaAssociations($productsCategory->getTable(), $productsCategory->id);
        return view('categories::edit')->with('productCategory', $productsCategory)->with('associatedMedia', $associatedMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsCategories $productsCategory)
    {
        $request->validate([
            'category_status' => 'required',
        ]);

        $productsCategory->category_name        = $request->category_name;
        $productsCategory->category_url         = $request->category_url;
        $productsCategory->category_description = $request->category_description;
        $productsCategory->category_status      = $request->category_status;
        $productsCategory->save();

        return redirect('admin/productsCategories/'.$productsCategory->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsCategories $productsCategory)
    {
        $productsCategory->delete();
        return redirect('/admin/productsCategories');
    }
}
