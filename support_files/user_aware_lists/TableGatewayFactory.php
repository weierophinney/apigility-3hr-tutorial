<?php

namespace Todo\V1\Rest\Lists;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ArraySerializable;

class TableGatewayFactory
{
    public function __invoke($services)
    {
        $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new ListsEntity());
        return new TableGateway('list', $services->get('Db\Todo'), null, $resultSetPrototype);
    }
}
