<?php
namespace Bookshelf\V1\Rest\Users;

class UsersResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Bibliotheque\User\UserMapper');
        return new UsersResource($mapper);
    }
}
