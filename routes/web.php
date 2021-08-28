<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| put all view route in groupe lang to load lang 
 */
Route::middleware('lang')->group(function () {
    Route::get('/', 'ProductController@index');
});

Route::get('lang/{lang}',function($lang){
    if(session()->has('lang')){
        session()->forget('lang');
    }
    if(in_array($lang,['ar','en'])){
        session()->put('lang',$lang); // save lang in session 
    }else{
        session()->put('lang','en'); // par default if user put anything else en ar 
    }
    return back();
});
