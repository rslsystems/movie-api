<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TrustProxies
 *
 * @package App\Http\Middleware
 */
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
