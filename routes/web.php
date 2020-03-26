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

Route::get('/', function () {

    $short_codes = \App\Link::inRandomOrder()->limit(5)->pluck('short_code');//value('short_code');//->get();//;

//    dd($short_codes);
    return view('welcome', ['short_codes' => $short_codes]);
});


Route::get('/r/{code}', function ($code) {

    $link = \App\Link::where('short_code', $code)->value('source_link');
//    dd($link);

    return redirect($link);
//    return view('welcome');
});
