<?php

namespace Todo\V1\Rest\Lists;

use ArrayObject;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ArraySerializable;

class UserListTableGatewayFactory
{
    public function __invoke($services)
    {
        $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new ArrayObject());
        return new TableGateway('user_list', $services->get('Db\Todo'), null, $resultSetPrototype);
    }
}
