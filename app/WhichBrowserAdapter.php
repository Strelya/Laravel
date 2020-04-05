<?php


namespace App;


class WhichBrowserAdapter implements UserAgentAdapterInterface
{
    protected $data;

    public function parse(string $useragent) {

        $this->data = new \WhichBrowser\Parser($useragent);

    }
    public function getBrowser()
    {
        return $browser_name = $this->data->browser->toString();
    }

    public function getEngine()
    {
        return $engine = $this->data->engine->toString();
    }

    public function getOs()
    {
        return $os = $this->data->os->toString();
    }

    public function getDevice()
    {
        return $device = $this->data->device->type;
    }
}
