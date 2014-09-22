<?php

namespace XTilDone\Lists;

interface MapperInterface
{
    public function create($userId, $title);

    public function delete($userId, $listId);

    public function fetch($userId, $listId);

    public function fetchAll($userId);

    public function update($userId, $listId, $title);

    public function isOwner($userId, $listId);

    public function canReadList($userId, $listId);

    public function canModifyList($userId, $listId);
}
