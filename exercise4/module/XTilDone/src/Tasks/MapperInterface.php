<?php

namespace XTilDone\Tasks;

interface MapperInterface
{
    public function create($userId, $listId, $name);

    public function delete($userId, $listId, $taskId);

    public function fetchAll($userId, $listId);

    public function update($userId, $listId, $taskId, $data);
}
