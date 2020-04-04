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

App::singleton(\App\IpAdapterInterface::class, function () {
    $reader = new \GeoIp2\Database\Reader(resource_path() . '/GeoLite2/GeoLite2-City.mmdb');
    return new \App\MaxmindAdapter($reader);

//    return new \App\IpapiAdapter();

});


Route::get('/', function () {
    $short_codes = \App\Link::inRandomOrder()->limit(5)->pluck('short_code');
    return view('welcome', ['title' => 'Random Links', 'short_codes' => $short_codes]);
});


Route::get('/r/{code}', function ($code, \App\IpAdapterInterface $adapter) {

    //dd($adapter);

    $link = \App\Link::where('short_code', $code)->get()->first();

    if($link === null)
    {
        return redirect('/');
    }

    $adapter->parse(request()->ip());

    $parser = new WhichBrowser\Parser(request()->userAgent());

    $statistic = new \App\Statistic();
    $statistic->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    $statistic->link_id = $link->id;
    $statistic->ip = request()->ip();
    $statistic->user_agent = request()->userAgent();
    $statistic->country_name = $adapter->getCountryName();
    $statistic->country_code = $adapter->getCountryCode();
    $statistic->city_name = $adapter->getCityName();
    $statistic->browser = $parser->browser->toString();
    $statistic->engine = $parser->engine->toString();
    $statistic->os = $parser->os->toString();
    $statistic->device = $parser->device->type;
    $statistic->save();

//    dd($statistic);
    return redirect($link->source_link);

});
