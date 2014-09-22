<?php
namespace Todo\V1\Rest\Users;

use ArrayObject;

class UsersEntity extends ArrayObject
{
    public function getArrayCopy()
    {
        $data = parent::getArrayCopy();
        unset($data['password']);
        return $data;
    }
}
