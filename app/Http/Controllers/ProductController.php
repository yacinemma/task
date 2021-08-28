<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller 
{

  /**
   * Display list of categorie.
   *
   * @return Response
   */
  public function index()
  {
    $categories = Category::whereNull('parent_id')->get();
    return view('welcome',compact("categories"));
    dump(Category::with('sub_categories','products')->get()[1]);
    dd(Product::with('category')->get()[1]);
  }

  public function getSubCategories(Request $request){
    if(isset($request->texto)){
        $subcategorias = Subcategoria::whereCategoria_id($request->texto)->get();
        return response()->json(
            [
                'lista' => $subcategorias,
                'success' => true
            ]
            );
    }else{
        return response()->json(
            [
                'success' => false
            ]
            );

    }

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>