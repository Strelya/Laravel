<?php


namespace App;

use Zarei\UserAgentParser\Facades\UserAgentParser;

class ZareiAdapter implements UserAgentAdapterInterface
{
    protected $data;

    public function parse(string $useragent) {

        $this->data = UserAgentParser::parse($useragent);

    }
    public function getBrowser()
    {
        return $browser_name = $this->data->browser()->name;
    }

    public function getEngine()
    {
        return $engine = $this->data->engine()->name;
    }

    public function getOs()
    {
        return $os = $this->data->os()->name;
    }

    public function getDevice()
    {
        return $device = $this->data->device()->type;
    }
}
