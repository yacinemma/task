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
    $lang = app()->getLocale();
    $categories = Category::whereNull('parent_id')->get();
    return view('welcome',compact("categories","lang"));
    dump(Category::with('sub_categories','products')->get()[1]);
    dd(Product::with('category','lang')->get()[1]);
  }

  public function loadSubCategorie(Request $request){
    if(isset($request->categorie_id)){
        $sub_categories = Category::with('sub_categories','products')->whereId($request->categorie_id)->first();
        return response()->json(
            [
                'result' => $sub_categories,
                'success' => true
            ]
            );
    }else{
        return response()->json(
            [
                'result' => false
            ]
            );

    }

  }
}

?>