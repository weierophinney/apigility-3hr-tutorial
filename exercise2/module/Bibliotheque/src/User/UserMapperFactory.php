<?php

namespace Bibliotheque\User;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ArraySerializable;

class UserMapperFactory
{
    public function __invoke($services)
    {
        $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new UserEntity());
        $tableGateway = new TableGateway('user', $services->get('Db\Bibliotheque'), null, $resultSetPrototype);

        return new UserMapper($tableGateway);
    }
}
