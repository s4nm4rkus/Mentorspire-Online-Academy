<?php

/*
 * All configuration options for Laravel Config
 */

return [
    'user' => [
        /*
         * When active, a user can only have one session active at a time
         * That is all other sessions for that user will be deleted when they log in
         * (They can only be logged into one place at a time, all others will be logged out)
         * AuthenticateSession middleware must be enabled
         */
        'single_login' => env('SINGLE_LOGIN', true),
    ],
];
