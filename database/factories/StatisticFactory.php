<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

function get_name($cc) {
    $country_names = json_decode(file_get_contents("http://country.io/names.json"), true);
    return $country_names[$cc];
}

$factory->define(\App\Statistic::class, function (Faker $faker) {
    $country_code = $faker->countryCode;
    $userAgent = $faker->userAgent;
    $country = get_name($country_code);
    $parser = new WhichBrowser\Parser($userAgent);
    return [
        'id' => $faker->uuid,
        'link_id' => \App\Link::inRandomOrder()->limit(1)->get()->first()->id,
        'ip' => $faker->ipv4,
        'country_name' => $country,
        'country_code' => $country_code,
        'city_name' => $faker->city,
        'device' => $parser->device->type,
        'os' => $parser->os->toString(),
        'engine' => $parser->engine->toString(),
        'browser' => $parser->browser->toString(),
        'user_agent' => $userAgent,
    ];
});
