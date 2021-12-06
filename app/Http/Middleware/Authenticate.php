<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Traits\ApiResponder;

class Authenticate extends Middleware
{
    use ApiResponder;

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return $this->errorResponse("Unauthorized", 401);
        }
    }
}
