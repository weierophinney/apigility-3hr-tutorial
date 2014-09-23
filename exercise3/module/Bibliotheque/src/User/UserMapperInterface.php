<?php

namespace Bibliotheque\User;

interface UserMapperInterface
{
    public function create($username, $password, $fullname);

    public function fetch($id);

    public function fetchAll();

    public function exists($id);

    public function byUsername($username);
}
