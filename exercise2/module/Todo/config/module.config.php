<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Todo\\V1\\Rpc\\Ping\\Controller' => 'Todo\\V1\\Rpc\\Ping\\PingControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'todo.rpc.ping' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ping',
                    'defaults' => array(
                        'controller' => 'Todo\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'todo.rpc.ping',
        ),
    ),
    'zf-rpc' => array(
        'Todo\\V1\\Rpc\\Ping\\Controller' => array(
            'service_name' => 'Ping',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'todo.rpc.ping',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Todo\\V1\\Rpc\\Ping\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Todo\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.todo.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Todo\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.todo.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
);
