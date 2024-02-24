<?php

namespace Dimsav\IpService;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
class IpService {
    public function __construct(Config $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;
    }
    /**
     * @return string|null
     */

}