<?php


namespace App;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class MaxmindAdapter implements IpAdapterInterface
{

    protected $reader;
    protected $record;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function parse(string $ip)
    {
        try {
            $this->record = $this->reader->city($ip);
        } catch (AddressNotFoundException $exception) {
            $this->record = $this->reader->city(env('DEFAULT_IP_ADDR'));
        }
    }

    public function getCountryName()
    {
        return $this->record->country->name;
    }

    public function getCountryCode()
    {
        return $this->record->country->isoCode;
    }

    public function getCityName()
    {
        return $this->record->city->name;
    }
}
