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
            'todo.rest.users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:users_id]',
                    'defaults' => array(
                        'controller' => 'Todo\\V1\\Rest\\Users\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'todo.rpc.ping',
            1 => 'todo.rest.users',
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
            'Todo\\V1\\Rest\\Users\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Todo\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.todo.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Todo\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.todo.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Todo\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.todo.v1+json',
                1 => 'application/json',
            ),
            'Todo\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.todo.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Todo\\V1\\Rest\\Users\\TableGateway' => 'Todo\\V1\\Rest\\Users\\TableGatewayFactory',
            'Todo\\V1\\Rest\\Users\\TableGatewayMapper' => 'Todo\\V1\\Rest\\Users\\TableGatewayMapperFactory',
            'Todo\\V1\\Rest\\Users\\UsersResource' => 'Todo\\V1\\Rest\\Users\\UsersResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Todo\\V1\\Rest\\Users\\Controller' => array(
            'listener' => 'Todo\\V1\\Rest\\Users\\UsersResource',
            'route_name' => 'todo.rest.users',
            'route_identifier_name' => 'users_id',
            'collection_name' => 'users',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => 'Todo\\V1\\Rest\\Users\\UsersEntity',
            'collection_class' => 'Todo\\V1\\Rest\\Users\\UsersCollection',
            'service_name' => 'Users',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Todo\\V1\\Rest\\Users\\UsersEntity' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'todo.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Todo\\V1\\Rest\\Users\\UsersCollection' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'todo.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Todo\\V1\\Rest\\Users\\Controller' => array(
            'input_filter' => 'Todo\\V1\\Rest\\Users\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Todo\\V1\\Rest\\Users\\Validator' => array(
            0 => array(
                'name' => 'username',
                'required' => true,
                'filters' => array(),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '255',
                        ),
                    ),
                ),
                'description' => 'Username (their email address)',
                'error_message' => 'Please provide a valid email address to use as the username.',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '8',
                        ),
                    ),
                ),
                'description' => 'Password to use for this user.',
                'error_message' => 'Please provide a valid password of at least 8 characters in length.',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '255',
                        ),
                    ),
                ),
                'description' => 'The user\'s full name.',
                'error_message' => 'Please provide the user\'s name.',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
    ),
);
