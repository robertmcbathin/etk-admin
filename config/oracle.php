<?php

return [
    'oracle' => [
    'driver'        => 'oracle',
    'tns'           => env('ORACLE_DB_TNS', ''),
    'host'          => env('ORACLE_DB_HOST', '176.193.77.210:1521'),
    'port'          => env('ORACLE_DB_PORT', '1521'),
    'database'      => env('ORACLE_DB_DATABASE', 'COTT'),
    'username'      => env('ORACLE_DB_USERNAME', 'HTTP'),
    'password'      => env('ORACLE_DB_PASSWORD', 'shame-1488'),
    'charset'       => env('ORACLE_DB_CHARSET', 'AL32UTF8'),
    'prefix'        => env('ORACLE_DB_PREFIX', ''),
    'prefix_schema' => env('ORACLE_DB_SCHEMA_PREFIX', ''),
    ],
];
