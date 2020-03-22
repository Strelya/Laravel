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
    $country = get_name($country_code);
    return [
        'id' => $faker->uuid,
        'link_id' => \App\Link::inRandomOrder()->limit(1)->get()->first()->id,
        'ip' => $faker->ipv4,
//        'country_name' => $faker->country,
        'country_name' => $country,
        'country_code' => $country_code,
//        'country_code' => $faker->countryCode,
        'city_name' => $faker->city,
        'user_agent' => $faker->userAgent,
    ];
});
