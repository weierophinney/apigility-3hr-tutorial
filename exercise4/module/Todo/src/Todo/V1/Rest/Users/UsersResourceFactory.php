<?php
namespace Todo\V1\Rest\Users;

class UsersResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Todo\V1\Rest\Users\TableGatewayMapper');
        return new UsersResource($mapper);
    }
}
