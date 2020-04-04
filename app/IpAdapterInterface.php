<?php


namespace App;


interface IpAdapterInterface
{
    public function parse(string $ip);

    public function getCountryName();
    public function getCountryCode();
    public function getCityName();
}
