<?php
return array(
    'db' => array(
        'adapters' => array(
            'Db\Todo' => array(
                'driver'   => 'Pdo_Sqlite',
                'database' => getcwd() . '/data/todo.db',
            ),
        ),
    ),
);
