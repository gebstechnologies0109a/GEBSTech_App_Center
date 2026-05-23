<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowIframeEmbedding
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $ancestors = config('gebs.frame_ancestors', '*');

        $response->headers->remove('X-Frame-Options');
        $response->headers->set('Content-Security-Policy', "frame-ancestors {$ancestors}");

        return $response;
    }
}
