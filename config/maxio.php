<?php

return [
    'key' => env('MAXIO_API_KEY', ''),
    'password' => env('MAXIO_API_PASSWORD', 'x'),
    'base_url' => 'https://'.env('MAXIO_SUBDOMAIN', '').'.chargify.com/',
    'subdomain' => env('MAXIO_SUBDOMAIN', '')
];