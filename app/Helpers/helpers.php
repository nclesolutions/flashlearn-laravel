<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('checkActivePage')) {
    /**
     * Check if the current page matches the given routes.
     *
     * @param array $routes
     * @return string
     */
    function checkActivePage(array $routes)
    {
        foreach ($routes as $route) {
            if (Request::is($route)) {
                return 'here show';
            }
        }

        return '';
    }
}


if (!function_exists('begroeting')) {
    function begroeting() {
        date_default_timezone_set('Europe/Amsterdam'); // Ensure the correct timezone is set
        $hour = date('H');

        if ($hour >= 0 && $hour < 12) {
            return 'Goedenmorgen';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'Goedenmiddag';
        } else {
            return 'Goedenavond';
        }
    }
}
