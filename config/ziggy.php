<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ziggy - Use your Laravel Named Routes inside JavaScript
    |--------------------------------------------------------------------------
    | https://github.com/tightenco/ziggy/
    |
    */

    'except' => [
        'debugbar.*', 'horizon.*', 'passport.*', 'telescope.*', 'ignition.*',
        'webhooks.*',
    ],



    /*
     * Set this to true if you want to manually import the route helper method.
     * When `true`; you need to rebuild your assets whenever you update this php package.
     */
    'skip-route-function' => true,
];
