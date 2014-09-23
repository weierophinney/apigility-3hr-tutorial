<?php

namespace Todo\V1\Rest\Lists;

use XTilDone\Lists\TableGatewayMapper;

class TableGatewayMapperFactory
{
    public function __invoke($services)
    {
        return new TableGatewayMapper(
            $services->get(__NAMESPACE__ . '\TableGateway'),
            __NAMESPACE__ . '\ListsEntity',
            __NAMESPACE__ . '\ListsCollection'
        );
    }
}
