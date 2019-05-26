<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 24.05.2019
 */

namespace KuzyT\Halfdream\General\Traits\Controllers;

use Illuminate\Http\Request;

/**
 * Trait IsTranslatableController.
 * Trait for controller, that can redirect to localized route.
 * @package KuzyT\Halfdream\General\Traits
 */
trait IsTranslatableController
{
    /**
     * @param Request $request
     */
    protected function redirectTranslatable(Request $request) {
        if (\Halfdream::multiLocale() && \Halfdream::isRedirectableRoute($request->route())) {
            // You can't get session without middleware here, so...
            $this->middleware(function ($request, $next) {
                $route = $request->route();

                // If you use multilanguage version, where is no correct url for translatable routs without locale
                // There is NOT 301 redirect - because browser will cache it and language changing won't work.
                redirect()->route(\Halfdream::routeFromRedirectable($route),
                    array_merge($route->parameters(), ['locale' => \Halfdream::locale()])
                )->send();

                return $next($request);
            });
        }
    }
}
