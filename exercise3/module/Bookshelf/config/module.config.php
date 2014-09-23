<?php
return array(
    'router' => array(
        'routes' => array(
            'bookshelf.rest.users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:users_id]',
                    'defaults' => array(
                        'controller' => 'Bookshelf\\V1\\Rest\\Users\\Controller',
                    ),
                ),
            ),
            'bookshelf.rest.books' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/books[/:books_id]',
                    'defaults' => array(
                        'controller' => 'Bookshelf\\V1\\Rest\\Books\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'bookshelf.rest.users',
            1 => 'bookshelf.rest.books',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Bookshelf\\V1\\Rest\\Users\\UsersResource' => 'Bookshelf\\V1\\Rest\\Users\\UsersResourceFactory',
            'Bookshelf\\V1\\Rest\\Books\\BooksResource' => 'Bookshelf\\V1\\Rest\\Books\\BooksResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Bookshelf\\V1\\Rest\\Users\\Controller' => array(
            'listener' => 'Bookshelf\\V1\\Rest\\Users\\UsersResource',
            'route_name' => 'bookshelf.rest.users',
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
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Bibliotheque\\User\\UserEntity',
            'collection_class' => 'Bibliotheque\\User\\UserCollection',
            'service_name' => 'Users',
        ),
        'Bookshelf\\V1\\Rest\\Books\\Controller' => array(
            'listener' => 'Bookshelf\\V1\\Rest\\Books\\BooksResource',
            'route_name' => 'bookshelf.rest.books',
            'route_identifier_name' => 'books_id',
            'collection_name' => 'books',
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
            'entity_class' => 'Bibliotheque\\Book\\BookEntity',
            'collection_class' => 'Bibliotheque\\Book\\BookCollection',
            'service_name' => 'Books',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Bookshelf\\V1\\Rest\\Users\\Controller' => 'HalJson',
            'Bookshelf\\V1\\Rest\\Books\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Bookshelf\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.bookshelf.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Bookshelf\\V1\\Rest\\Books\\Controller' => array(
                0 => 'application/vnd.bookshelf.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Bookshelf\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.bookshelf.v1+json',
                1 => 'application/json',
            ),
            'Bookshelf\\V1\\Rest\\Books\\Controller' => array(
                0 => 'application/vnd.bookshelf.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Bookshelf\\V1\\Rest\\Users\\UsersEntity' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'bookshelf.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Bookshelf\\V1\\Rest\\Users\\UsersCollection' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'bookshelf.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ),
            'Bookshelf\\V1\\Rest\\Books\\BooksEntity' => array(
                'entity_identifier_name' => 'book_id',
                'route_name' => 'bookshelf.rest.books',
                'route_identifier_name' => 'books_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Bookshelf\\V1\\Rest\\Books\\BooksCollection' => array(
                'entity_identifier_name' => 'book_id',
                'route_name' => 'bookshelf.rest.books',
                'route_identifier_name' => 'books_id',
                'is_collection' => true,
            ),
            'Bibliotheque\\User\\UserEntity' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'bookshelf.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Bibliotheque\\User\\UserCollection' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'bookshelf.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ),
            'Bibliotheque\\Book\\BookEntity' => array(
                'entity_identifier_name' => 'book_id',
                'route_name' => 'bookshelf.rest.books',
                'route_identifier_name' => 'books_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Bibliotheque\\Book\\BookCollection' => array(
                'entity_identifier_name' => 'book_id',
                'route_name' => 'bookshelf.rest.books',
                'route_identifier_name' => 'books_id',
                'is_collection' => true,
            ),
        ),
    ),
);
