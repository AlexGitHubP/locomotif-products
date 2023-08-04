<?php

namespace Locomotif\Products\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Locomotif\Products\Models\ProductsAttributesValues;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsAttributesValuesController extends Controller
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
    public static function index($attr_id)
    {
        
        
        $results = DB::table('products_attributes_values')
            ->select('attr_value_identifier', 'attr_value_name', DB::raw('GROUP_CONCAT(DISTINCT CONCAT(attr_value, "_", id) ORDER BY attr_value ASC SEPARATOR ",") as unique_values'))
            ->where('attr_id', '=', $attr_id)
            ->groupBy('attr_value_identifier', 'attr_value_name')
            ->get();
            
        if(count($results)>0){
            
            foreach ($results as $key => $result) {
                $attr_values[$result->attr_value_name] = explode(',', $result->unique_values);
                foreach ($attr_values[$result->attr_value_name] as $kk => $vv) {
                    $attr_values[$result->attr_value_name][$kk] = explode('_', $vv);
                }       
            }
        }else{
            $attr_values = 0;
        }
        
        return view('attributes_values::list')->with('attr_values', $attr_values);
        
    }

    public function countAttr($attr_id){
        $results = DB::table('products_attributes_values')
        ->select('attr_value_identifier', 'attr_value_name')
        ->where('attr_id', '=', $attr_id)
        ->groupBy('attr_value_identifier', 'attr_value_name')
        ->get();
        
        $total = count($results);

        return $total;
        
    }

    public function getAssocValues(Request $request){
        $attr_id = $request->post('attr_id');
        $attr_values = DB::table('products_attributes_values')->groupBy('attr_value_identifier')->having('attr_id', '=', $attr_id)->get();
        return response()->json($attr_values);
    }

    public function getGroupedAssocValues(Request $request){
        $attr_identifier = $request->post('attr_identifier');
        $attr_values = DB::table('products_attributes_values')->where('attr_value_identifier', '=', $attr_identifier)->get();
        return response()->json($attr_values);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($attr_id)
    {
        return view('attributes_values::create')->with('attr_id', $attr_id);
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
            'attr_value_identifier' => 'required',
            'attr_value'            => 'required',
        ]);


        $attrValues = $request->attr_value;
        $explodedAttrValues = explode(',', $attrValues);

        if(!empty($explodedAttrValues)){
            foreach ($explodedAttrValues as $key => $value) {
                $productsAttributesValue = new ProductsAttributesValues();
                $productsAttributesValue->attr_id               = $request->attr_id;
                $productsAttributesValue->attr_value_name       = $request->attr_value_name;
                $productsAttributesValue->attr_value_identifier = $request->attr_value_identifier;
                $productsAttributesValue->attr_value            = $value;
                $productsAttributesValue->attr_value_status     = $request->attr_value_status;
                $productsAttributesValue->save();
            }
        }
       
        return redirect('admin/productsAttributes/'.$request->attr_id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsAttributesValues  $productsAttributesValues
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsAttributesValues $productsAttributesValues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsAttributesValues  $productsAttributesValues
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsAttributesValues $productsAttributesValues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsAttributesValues  $productsAttributesValues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsAttributesValues $productsAttributesValues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsAttributesValues  $productsAttributesValues
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductsAttributesValues $productsAttributesValues)
    {
        $productsAttributesValues->delete();
        
        return redirect('admin/productsAttributes/'.$request->attr_id.'/edit');
    }

    public function ajaxDelete(Request $request, ProductsAttributesValues $productsAttributesValues)
    {
        $attr_value_id = $request->post('attr_value_id');
        $atribute_element = ProductsAttributesValues::find($attr_value_id); // find the user by their ID
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
    
}
