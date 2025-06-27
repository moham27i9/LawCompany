<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs التي تُستثنى من التحقق من CSRF
     *
     * @var array<int, string>
     */
    protected $except = [
    // 'api/messages',
    // 'api/messages/*',
];

}
