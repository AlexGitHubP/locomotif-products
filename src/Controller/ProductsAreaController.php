<?php

namespace Locomotif\Products\Controller;

use Locomotif\Products\Models\ProductsArea;
use Locomotif\Media\Controller\MediaController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsAreaController extends Controller
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
        $areas = ProductsArea::all();
        foreach ($areas as $key => $value) {
            $areas[$key]->status_nice = mapStatus($value->status);
        }
        return view('areas::list')->with('list', $areas);
    }

    public function getAreas($product_id){
        $allAreas = ProductsArea::all();
        foreach ($allAreas as $key => $area) {
            $allAreas[$key]->selected = DB::table('products_to_areas')->where([
                ['product_id', '=', $product_id],
                ['area_id',    '=', $area->id]
            ])->exists();
        }
        
        return view('areas::associateAreas')->with('product_id', $product_id)->with('list', $allAreas);
    }

    public function addAreasToProducts(Request $request){
        
        if(isset($request->areas) && count($request->areas) !=0){
            $this->insertAreaToProduct($request);
        }else{
            $this->clearAllAreas($request);
        }

        $response['success'] = true;
        $response['message'] = 'Asocieri cu succes.';
        $response['type']    = 'category';

        return response()->json($response);
        
    }

    public function insertAreaToProduct($request){
        DB::table('products_to_areas')->where([
            ['product_id',  '=', $request->pid]
        ])->delete();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($request->areas as $key => $value) {
            DB::table('products_to_areas')->insert([
                'product_id'  => $request->pid,
                'area_id'    => $value,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }
    public function clearAllAreas($request){
        DB::table('products_to_areas')->where([
            ['product_id',  '=', $request->pid]
        ])->delete();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas::create');
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
            'area_name' => 'required',
            'area_url'  => 'required',
        ]);

        $productArea = new ProductsArea();

        $productArea->area_name        = $request->area_name;
        $productArea->area_url         = $request->area_url;
        $productArea->ordering         = getOrdering('products_areas', 'ordering');
        $productArea->status  = $request->status;

        $productArea->save();

        return redirect('admin/productsArea/'.$productArea->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsArea  $productsArea
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsArea $productsArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsArea  $productsArea
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsArea $productsArea)
    {
        $associatedMedia      = app(MediaController::class)->mediaAssociations($productsArea->getTable(), $productsArea->id);
        return view('areas::edit')->with('item', $productsArea)->with('associatedMedia', $associatedMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsArea  $productsArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsArea $productsArea)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $productsArea->area_name   = $request->area_name;
        $productsArea->area_url    = $request->area_url;
        $productsArea->status      = $request->status;
        $productsArea->save();

        return redirect('admin/productsArea/'.$productsArea->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsArea  $productsArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsArea $productsArea)
    {
        $productsArea->delete();
        return redirect('/admin/productsArea');
    }
}
