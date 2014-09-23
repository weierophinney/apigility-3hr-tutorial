<?php

namespace Bibliotheque\Book;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ArraySerializable;

class BookMapperFactory
{
    public function __invoke($services)
    {
        $resultSetPrototype = new HydratingResultSet(new ArraySerializable(), new BookEntity());
        $tableGateway = new TableGateway('book', $services->get('Db\Bibliotheque'), null, $resultSetPrototype);

        return new BookMapper($tableGateway);
    }
}
