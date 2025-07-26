<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectOldUrls
{
    protected $oldUrls;

    public function __construct()
    {
        // Load the list of old URLs into a fast lookup structure
        $this->oldUrls = array_flip(config('old_urls', []));
    }

    public function handle(Request $request, Closure $next): Response
    {
        $requestedPath = $request->getPathInfo();

        // Check if the requested path exists in our list of old URLs
        if (isset($this->oldUrls[$requestedPath])) {
            // If it's an old URL, permanently redirect to the homepage.
            return redirect()->to('/', 301);
        }

        // If it's not an old URL, let the request continue as normal.
        return $next($request);
    }
}
