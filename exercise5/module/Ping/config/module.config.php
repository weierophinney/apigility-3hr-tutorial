<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Ping\\V1\\Rpc\\Ping\\Controller' => 'Ping\\V1\\Rpc\\Ping\\PingControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'ping.rpc.ping' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ping',
                    'defaults' => array(
                        'controller' => 'Ping\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'ping.rpc.ping',
        ),
    ),
    'zf-rpc' => array(
        'Ping\\V1\\Rpc\\Ping\\Controller' => array(
            'service_name' => 'Ping',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'ping.rpc.ping',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Ping\\V1\\Rpc\\Ping\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Ping\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.ping.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Ping\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.ping.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
);
