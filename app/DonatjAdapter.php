<?php


namespace App;

class DonatjAdapter implements UserAgentAdapterInterface
{
    protected $data;

    public function parse(string $useragent) {

        $this->data = parse_user_agent($useragent);

    }
    public function getBrowser()
    {
        return $browser_name = $this->data['browser'];
    }

    public function getEngine()
    {
        return "No_data";
    }

    public function getOs()
    {
        return $os = $this->data['platform'];
    }

    public function getDevice()
    {
        return "No_data";
    }
}
