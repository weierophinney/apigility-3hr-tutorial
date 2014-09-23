# Users collection

The following assets will help implementing /users:

* `TableGatewayFactory` provides a factory for creating a `Zend\Db\TableGateway\TableGateway`
  instance associated with the `user` table, setting up the appropriate hydration strategy
  for resultsets.
* `TableGatewayMapperFactory` provides a factory for creating an instance of the
  `XTilDone\Users\TableGatewayMapper`, and ensuring it is injected with the
  `TableGateway` we create above.

Copy these files into `module/Todo/src/Todo/V1/Rest/Users/` to get started.

You will also need to update the `UsersEntity` to extend `ArrayObject` so that it
can be hydrated.

You will also need to map them into the `factories` sub-array of the `service_manager`
section of your `module/Todo/config/module.config.php`:

        'Todo\\V1\\Rest\\Users\\TableGateway' => 'Todo\\V1\\Rest\\Users\\TableGatewayFactory',
        'Todo\\V1\\Rest\\Users\\TableGatewayMapper' => 'Todo\\V1\\Rest\\Users\\TableGatewayMapperFactory',

You can now inject the $mapper into the `UsersResouce` within the `UsersResouceFactory`. The
relevant code to retrieve from the `$services` ServiceManager object is:

    $mapper = $services->get('Todo\V1\Rest\Users\TableGatewayMapper');
