<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    'api/v1/login',
    'api/v1/register',
    'my-account/my-documents/delete',
    'address/delete',
    'form-search',
    'api/v1/document-upload',
    'api/v1/cart/add-product',
    'api/v1/cart/view',
    'api/v1/cart/update',
    'api/v1/cart/delete-product',
    'api/v1/address/add-address',
    'api/v1/address/view',
    'api/v1/address/update',
    'api/v1/address/delete-address',
    'api/v1/order/link-address-to-order',
    'api/v1/order/order-status-to-confirmed',
    ];

    public function handle($request, Closure $next)
    {
        if(strpos($request->getRequestUri(),'api') != FALSE)
        {
            return $next($request);
        }
            
        if ($this->isReading($request) || $this->shouldPassThrough($request) || $this->tokensMatch($request)) {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }
}
