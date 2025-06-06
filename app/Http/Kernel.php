<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'isAdmin' => \App\Http\Middleware\IsAdmin::class, // Add this line
    ];

    protected $middlewareGroups = [
    'web' => [
        // other middleware
        \App\Http\Middleware\PreventBackHistory::class,
    ],
];

}
