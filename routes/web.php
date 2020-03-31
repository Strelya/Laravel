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
    $short_codes = \App\Link::inRandomOrder()->limit(5)->pluck('short_code');
    return view('welcome', ['title' => 'Random Links', 'short_codes' => $short_codes]);
});


Route::get('/r/{code}', function ($code) {

    $link = \App\Link::where('short_code', $code)->get()->first();

    if($link === null)
    {
        return redirect('/');
    }

    $reader = new \GeoIp2\Database\Reader(resource_path() . '/GeoLite2/GeoLite2-City.mmdb');

    try {
        $record = $reader->city(request()->ip());
    }
    catch (\GeoIp2\Exception\AddressNotFoundException $exception) {
        $record = $reader->city(env('DEFAULT_IP_ADDR'));
    }

    $parser = new WhichBrowser\Parser(request()->userAgent());

    $statistic = new \App\Statistic();
    $statistic->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    $statistic->link_id = $link->id;
    $statistic->ip = request()->ip();
    $statistic->user_agent = request()->userAgent();
    $statistic->country_name = $record->country->name;
    $statistic->country_code = $record->country->isoCode;
    $statistic->city_name = $record->city->name;
    $statistic->browser = $parser->browser->toString();
    $statistic->engine = $parser->engine->toString();
    $statistic->os = $parser->os->toString();
    $statistic->device = $parser->device->type;
    $statistic->save();

//    dd($statistic);
    return redirect($link->source_link);

});
