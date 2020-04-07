<?php


namespace App;

use UAParser\Parser;

class UAparserAdapter implements UserAgentAdapterInterface
{
    protected $data;

    public function parse(string $useragent) {

        $parser = Parser::create();
        $this->data = $parser->parse($useragent);

    }
    public function getBrowser()
    {
        return $browser_name = $this->data->ua->toString();
    }

    public function getEngine()
    {
        return "Other_engine";
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
