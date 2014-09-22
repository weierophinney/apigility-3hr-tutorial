<?php

namespace XTilDone\ListUsers;

interface MapperInterface
{
    public function create($ownerId, $listId, array $data);
    
    public function delete($ownerId, $listId, $userId);

    public function fetch($consumerId, $listId, $userId);

    public function fetchAll($consumerId, $listId);

    public function update($ownerId, $listId, $userId, array $permissions);
}
