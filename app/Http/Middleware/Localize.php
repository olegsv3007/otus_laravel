<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localize
{
    private const DEFAULT_LOCALE = 'en';
    private const PARAMETER_LOCALE = 'locale';

    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getRequestLocale($request) ?? self::DEFAULT_LOCALE;
        $this->localize($locale);
        $request->route()->forgetParameter(self::PARAMETER_LOCALE);
        return $next($request);
    }

    private function getRequestLocale(Request $request): ?string
    {
        return $request->route()->parameter(self::PARAMETER_LOCALE, null);
    }

    private function localize(string $locale): void
    {
        App::setLocale($locale);
    }
}
