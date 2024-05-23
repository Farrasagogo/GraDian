<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'update-firebase',
        'updatesinarauto',
        'updatesiramauto',
        'updatesinar',
        'update-firebaseobat',
        'update-firebaseobat2',
        'updateobatauto',
        'jadwal/delete/*',
        'jadwal/update/*',
        'jadwal/edit/*',
        'jadwal/store',
        'login',
        'logout',
    ];
}
