<?php

namespace XTilDone\Users;

interface MapperInterface
{
    public function create($username, $password, $fullname);

    public function fetch($id);

    public function fetchAll();

    public function exists($id);

    public function byUsername($username);
}
