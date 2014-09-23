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
            'todo.rest.lists' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/lists[/:lists_id]',
                    'defaults' => array(
                        'controller' => 'Todo\\V1\\Rest\\Lists\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'todo.rpc.ping',
            1 => 'todo.rest.users',
            2 => 'todo.rest.lists',
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
            'Todo\\V1\\Rest\\Lists\\Controller' => 'HalJson',
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
            'Todo\\V1\\Rest\\Lists\\Controller' => array(
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
            'Todo\\V1\\Rest\\Lists\\Controller' => array(
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
            'Todo\\V1\\Rest\\Lists\\ListsResource' => 'Todo\\V1\\Rest\\Lists\\ListsResourceFactory',
            'Todo\\V1\\Rest\\Lists\\TableGateway' => 'Todo\\V1\\Rest\\Lists\\TableGatewayFactory',
            'Todo\\V1\\Rest\\Lists\\TableGatewayMapper' => 'Todo\\V1\\Rest\\Lists\\TableGatewayMapperFactory',
            'Todo\\V1\\Rest\\Lists\\UserListTableGateway' => 'Todo\\V1\\Rest\\Lists\\UserListTableGatewayFactory',
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
        'Todo\\V1\\Rest\\Lists\\Controller' => array(
            'listener' => 'Todo\\V1\\Rest\\Lists\\ListsResource',
            'route_name' => 'todo.rest.lists',
            'route_identifier_name' => 'lists_id',
            'collection_name' => 'lists',
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
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Todo\\V1\\Rest\\Lists\\ListsEntity',
            'collection_class' => 'Todo\\V1\\Rest\\Lists\\ListsCollection',
            'service_name' => 'Lists',
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
            'Todo\\V1\\Rest\\Lists\\ListsEntity' => array(
                'entity_identifier_name' => 'list_id',
                'route_name' => 'todo.rest.lists',
                'route_identifier_name' => 'lists_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Todo\\V1\\Rest\\Lists\\ListsCollection' => array(
                'entity_identifier_name' => 'list_id',
                'route_name' => 'todo.rest.lists',
                'route_identifier_name' => 'lists_id',
                'is_collection' => true,
            ),
        ),
    ),
);
