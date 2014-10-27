<?php

namespace Bibliotheque\Book;

interface BookMapperInterface
{
    public function create($title, $author, $isbn);
    
    public function fetch($id);

    public function fetchAll();

    public function delete($id);

    public function update($bookId, $data);
}
