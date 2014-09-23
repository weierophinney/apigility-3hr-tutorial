<?php
// Config for the Bibliotheque module

return array(
    'db' => array(
        'adapters' => array(
            'Db\Bibliotheque' => array(
                'driver'   => 'Pdo_Sqlite',
                'database' => getcwd() . '/data/bookshelf.db',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Bibliotheque\User\UserMapper' => 'Bibliotheque\User\UserMapperFactory',
            'Bibliotheque\Book\BookMapper' => 'Bibliotheque\Book\BookMapperFactory',
        ),
    ),
    'zf-oauth2' => array(
        'storage' => 'ZF\\OAuth2\\Adapter\\PdoAdapter',
        'access_lifetime' => 7200,
        'db' => array(
            'dsn_type' => 'PDO',
            'dsn' => 'sqlite:' . realpath(getcwd() . '/data/bookshelf.db'),
            'username' => null,
            'password' => null,
        ),
        'storage_settings' => array(
            'user_table' => 'user',
        ),
    ),
);
