<?php
namespace Bookshelf\V1\Rest\Books;

class BooksResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Bibliotheque\Book\BookMapper');
        return new BooksResource($mapper);
    }
}
