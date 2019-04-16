<?php

namespace App\Tests\Helper;

use Codeception\Module;

class Configuration extends Module
{
    /**
     * @param string $name
     * @return mixed
     */
    public function getUrl(string $name)
    {
        return $this->config[$name];
    }
}
