<?php

namespace KuzyT\Halfdream\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Halfdream::multiLocale()) {
            $locales = \Halfdream::locales();

            if ($locale = $request->route('locale')) {

                if (!in_array($locale, $locales)) {
                    $locale = config('halfdream.locale.default');
                }

                locale($locale);

                $request->route()->forgetParameter('locale');
            }
            else
            {
                if(!session()->has('locale')) {
                    locale($request->getPreferredLanguage($locales));
                } else {
                    // Check and set locale from session by helper
                    locale();
                }
            }
        }

        return $next($request);
    }
}
