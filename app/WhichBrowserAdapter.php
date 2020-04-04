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
        // TODO: Implement getBrowser() method.
    }

    public function getEngine()
    {
        // TODO: Implement getEngine() method.
    }

    public function getOs()
    {
        // TODO: Implement getOs() method.
    }

    public function getDevice()
    {
        // TODO: Implement getDevice() method.
    }
}
