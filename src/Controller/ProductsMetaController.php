<?php

namespace Locomotif\Products\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Locomotif\Products\Models\ProductsMeta;
use Illuminate\Support\Facades\DB;

class ProductsMetaController extends Controller
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
    public function index($attr_id)
    {
        
        $results = DB::table('products_metas')
                        ->select('meta_name','meta_key', 'meta_attribute', 'meta_value')
                        ->where('pid', '=', $attr_id)
                        ->groupBy('meta_key', 'meta_value')
                        ->get();
                        
        if(count($results)>0){
            foreach ($results as $key => $result) {    
                $value = DB::table('products_metas')->select('meta_value', DB::raw('GROUP_CONCAT(DISTINCT CONCAT(meta_value, "_", id) ORDER BY meta_value ASC SEPARATOR ",") as unique_values'))->where('meta_key', '=', $result->meta_key)->where('meta_attribute', '=', $result->meta_attribute)->first();
                $value = explode('_', $value->unique_values);
                $productsAttributes[$result->meta_key][$result->meta_attribute] = $value;
            }
        }else{
            $productsAttributes = 0;
        }
        
        
        return view('attributes::listSubtemplate')->with('productsAttributes', $productsAttributes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAjax(Request $request){

        $meta_values = (!empty($request->meta_value) && is_array($request->meta_value)) ? array_filter($request->meta_value) : $request->meta_value;
        foreach ($meta_values as $key => $value) {
            $productMeta = new ProductsMeta();
            $productMeta->pid               = $request->pid;
            $productMeta->meta_name         = $request->meta_name;
            $productMeta->meta_owner        = $request->meta_owner;
            $productMeta->meta_key          = $request->meta_key;
            $productMeta->meta_attribute    = $request->meta_attribute;
            $productMeta->meta_combined_key = $request->meta_combined_key;
            $productMeta->meta_value        = $value;
            $productMeta->save();
        }

        $response['success'] = true;
        $response['type'] = 'productMeta';
        $response['message'] = 'Atributul a fost asociat';
        $response['infos'] = $productMeta;

        return response()->json($response);


    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'url' => 'required',
        // ]);
        
        $meta_values = (!empty($request->meta_value) && is_array($request->meta_value)) ? array_filter($request->meta_value) : $request->meta_value;
        foreach ($meta_values as $key => $value) {
            $productMeta = new ProductsMeta();
            $productMeta->pid               = $request->pid;
            $productMeta->meta_name         = $request->meta_name;
            $productMeta->meta_owner        = $request->meta_owner;
            $productMeta->meta_key          = $request->meta_key;
            $productMeta->meta_attribute    = $request->meta_attribute;
            $productMeta->meta_combined_key = $request->meta_combined_key;
            $productMeta->meta_value        = $value;
            $productMeta->save();
        }
        

        return redirect('admin/products/'.$request->pid.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsMeta  $productsMeta
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsMeta $productsMeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsMeta  $productsMeta
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsMeta $productsMeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsMeta  $productsMeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsMeta $productsMeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsMeta  $productsMeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsMeta $productsMeta)
    {
        //
    }
    public function ajaxDelete(Request $request, ProductsMeta $productsMeta)
    {
        $attr_value_id = $request->post('attr_value_id');
        $atribute_element = ProductsMeta::find($attr_value_id); // find the user by their ID
        $response['success'] = ($atribute_element->delete()) ? true : false;
        if($response['success']){
            $response['message'] = 'Elementul a fost sters.';
            $response['type'] = 'success';
        }else{
            $response['message'] = 'A intervenit o eroare, va rugam incercati din nou.';
            $response['type'] = 'error';
        }
        return response()->json($response);
    }

    public function checkMetaExists(Request $request, ProductsMeta $productsMeta){
        $meta_attribute = $request->post('meta_attribute');
        $pid            = $request->post('pid');
        $meta_key       = $request->post('meta_key');
        
        $atribute_element = ProductsMeta::where('meta_attribute', $meta_attribute)
                                    ->where('pid', $pid)
                                    ->where('meta_key', $meta_key)
                                    ->first();
        $response['exists'] = ($atribute_element) ? true : false;
        
        return response()->json($response);
    }
}
