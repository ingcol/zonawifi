<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
protected $except =[
         'http://167.172.28.167/portalCautivoRegistrar?api_key=key_cur_prod_fnPqT5xQEi5Vcb9wKwbCf65c3BjVGyBB'
    ];
}
