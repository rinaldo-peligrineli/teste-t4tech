<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\PersonalUserTokenRepositoryInterface;

class VerifyPersonalAuthtentication
{

    protected $personalUserTokenRepositoryInterface;

    public function __construct(PersonalUserTokenRepositoryInterface $personalUserTokenRepositoryInterface)
    {
        $this->personalUserTokenRepositoryInterface = $personalUserTokenRepositoryInterface;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('x-authorization');

        $personalUserToken = $this->personalUserTokenRepositoryInterface->getTokenByKey($token);

        if(!$personalUserToken) {
            abort(401);
        }

        return $next($request);
    }
}
