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

use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\App;

App::singleton(\App\IpAdapterInterface::class, function () {
    $reader = new Reader(resource_path() . '/GeoLite2/GeoLite2-City.mmdb');
    return new \App\MaxmindAdapter($reader);

//    return new \App\IpapiAdapter();

});

App::singleton(\App\UserAgentAdapterInterface::class, function () {

//    return new \App\WhichBrowserAdapter();

    return new \App\ZareiAdapter();
});


Route::get('/', function () {
    $short_codes = \App\Link::inRandomOrder()->limit(5)->pluck('short_code');
    return view('welcome', ['title' => 'Random Links', 'short_codes' => $short_codes]);
});


Route::get('/r/{code}', function ($code, \App\IpAdapterInterface $ipAdapter, \App\UserAgentAdapterInterface $UAadapter) {

    $link = \App\Link::where('short_code', $code)->get()->first();

    if($link === null)
    {
        return redirect('/');
    }

    $ipAdapter->parse(request()->ip());
    $UAadapter->parse(request()->userAgent());

    $statistic = new \App\Statistic();
    $statistic->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
    $statistic->link_id = $link->id;
    $statistic->ip = request()->ip();
    $statistic->user_agent = request()->userAgent();
    $statistic->country_name = $ipAdapter->getCountryName();
    $statistic->country_code = $ipAdapter->getCountryCode();
    $statistic->city_name = $ipAdapter->getCityName();
    $statistic->browser = $UAadapter->getBrowser();
    $statistic->engine = $UAadapter->getEngine();
    $statistic->os = $UAadapter->getOs();
    $statistic->device = $UAadapter->getDevice();
    $statistic->save();

//    dd($statistic);
    return redirect($link->source_link);

});

//todo: Роут на страницу опций, где переключать адаптеры, после авторизации
//todo: На странице опций варианты авторизации - стандартная, гитхаб, Твиттер, Гугл
