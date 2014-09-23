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
);
