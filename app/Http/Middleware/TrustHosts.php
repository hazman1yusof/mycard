<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array
     */
    public function hosts()
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
            "http://175.143.1.33:8080/",
            "http://175.143.1.33:8080/*",
            "http://175.143.1.33",
            "http://175.143.1.33:8080",
        ];
    }
}
