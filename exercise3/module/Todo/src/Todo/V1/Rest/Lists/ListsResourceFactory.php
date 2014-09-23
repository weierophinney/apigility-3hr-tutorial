<?php
namespace Todo\V1\Rest\Lists;

class ListsResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Todo\V1\Rest\Lists\TableGatewayMapper');
        return new ListsResource($mapper);
    }
}
