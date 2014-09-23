<?php

namespace XTilDone\Lists;

interface MapperInterface
{
    public function create($title);

    public function delete($listId);

    public function fetch($listId);

    public function fetchAll();

    public function update($listId, $title);
}
