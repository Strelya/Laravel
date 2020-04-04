<?php


namespace App;


interface UserAgentAdapterInterface
{
    public function parse(string $useragent);

    public function getBrowser();
    public function getEngine();
    public function getOs();
    public function getDevice();
}
