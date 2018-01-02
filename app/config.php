<?php
return [
    'database' => [
        'default' => 'sqlite',
        'connections' => [
            'sqlite' => [
                'database_type' => 'sqlite',
                'database_file' => 'db/database.db'
            ],
            'mysql' => [
                'host'
            ]
        ]
    ],
    'debug' => true,
];
