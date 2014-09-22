Exercise 2
==========

The following assets will help you with Exercise 2:

- `TableGatewayFactory` provides a factory for creating a
  `Zend\Db\TableGateway\TableGateway` instance associated with the `user` table,
  setting up the appropriate hydration strategy for resultsets.
- `TableGatewayMapperFactory` provides a factory for creating an instance of the
  `XTilDone\Users\TableGatewayMapper`, and ensuring it is injected with the
  `TableGateway` we create above.

You can study these to understand how you might write your `UsersResourceFactory`.

Copy these files into `module/Todo/src/Todo/V1/Rest/Users/` to get started. You
will also want to map them in your `module/Todo/config/module.config.php`:

    'service_manager' => array(
        'factories' => array(
            'Todo\\V1\\Rest\\Users\\TableGateway' => 'Todo\\V1\\Rest\\Users\\TableGatewayFactory',
            'Todo\\V1\\Rest\\Users\\TableGatewayMapper' => 'Todo\\V1\\Rest\\Users\\TableGatewayMapperFactory',
            'Todo\\V1\\Rest\\Users\\UsersResource' => 'Todo\\V1\\Rest\\Users\\UsersResourceFactory',
        ),
    ),
