<?php


namespace App;

use UAParser\Parser;

class UAparserAdapter implements UserAgentAdapterInterface
{
    protected $data;

    public function parse(string $useragent) {

        $result = Parser::create();
        $this->data = $result->parse($useragent);

    }
    public function getBrowser()
    {
        return $browser_name = $this->data->ua->toString();
    }

    public function getEngine()
    {
        return "No_data";
    }

    public function getOs()
    {
        return $os = $this->data->os->toString();
    }

    public function getDevice()
    {
        return $device = $this->data->device->family;
    }
}
