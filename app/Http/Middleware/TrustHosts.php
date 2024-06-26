<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\URL;
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
        URL::forceScheme('https');
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
