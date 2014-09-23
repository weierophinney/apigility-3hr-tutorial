<?php

namespace Todo\V1\Rest\Users;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ArraySerializable;

class TableGatewayFactory
{
    public function __invoke($services)
    {
        $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new UsersEntity());
        return new TableGateway('user', $services->get('Db\Todo'), null, $resultSetPrototype);
    }
}
