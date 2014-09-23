# Simple Lists collection

The following assets will help implementing /lists:

* `TableGatewayFactory` provides a factory for creating a `Zend\Db\TableGateway\TableGateway`
  instance associated with the `user` table, setting up the appropriate hydration strategy
  for resultsets.
* `TableGatewayMapperFactory` provides a factory for creating an instance of the
  `XTilDone\Lists\TableGatewayMapper`, and ensuring it is injected with the
  `TableGateway` we create above.

Copy these files into `module/Todo/src/Todo/V1/Rest/Lists/` to get started.

You will also need to update the `ListsEntity` to extend `ArrayObject` so that it
can be hydrated.

You will also need to map them into the `factories` sub-array of the `service_manager`
section of your `module/Todo/config/module.config.php`:

        'Todo\\V1\\Rest\\Lists\\TableGateway' => 'Todo\\V1\\Rest\\Lists\\TableGatewayFactory',
        'Todo\\V1\\Rest\\Lists\\TableGatewayMapper' => 'Todo\\V1\\Rest\\Lists\\TableGatewayMapperFactory',

You can now inject the $mapper into the `ListsResouce` within the `ListsResouceFactory`. The
relevant code to retrieve from the `$services` ServiceManager object is:

    $mapper = $services->get('Todo\V1\Rest\Lists\TableGatewayMapper');
