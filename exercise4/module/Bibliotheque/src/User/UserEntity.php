<?php

namespace Bibliotheque\User;

use ArrayObject;

class UserEntity extends ArrayObject
{
    public function getArrayCopy()
    {
        $data = parent::getArrayCopy();
        unset($data['password']);
        return $data;
    }
}
