<?php

namespace Todo\V1\Rest\Users;

use XTilDone\Users\TableGatewayMapper;

class TableGatewayMapperFactory
{
    public function __invoke($services)
    {
        return new TableGatewayMapper(
            $services->get('Todo\V1\Rest\Users\TableGateway'),
            __NAMESPACE__ . '\UsersEntity',
            __NAMESPACE__ . '\UsersCollection'
        );
    }
}
