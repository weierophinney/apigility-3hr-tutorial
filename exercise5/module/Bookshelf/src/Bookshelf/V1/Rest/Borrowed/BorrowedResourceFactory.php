<?php
namespace Bookshelf\V1\Rest\Borrowed;

class BorrowedResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Bibliotheque\Book\BookMapper');
        return new BorrowedResource($mapper);
    }
}
