<?php

namespace Bibliotheque\Book;

use DomainException;
use Rhumsaa\Uuid\Uuid;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway as DbTableGatewayPaginator;
use Zend\Paginator\Adapter\DbSelect as DbSelectPaginator;

class BookMapper implements BookMapperInterface
{
    protected $collectionClass;
    protected $entityClass;
    protected $table;

    public function __construct(
        TableGatewayInterface $table,
        $entityClass = 'Bibliotheque\Book\BookEntity',
        $collectionClass = 'Bibliotheque\Book\BookCollection'
    ) {
        $this->table = $table;
        $this->entityClass = $entityClass;
        $this->collectionClass = $collectionClass;
    }

    public function create($title, $author, $isbn)
    {
        $bookId = (string) Uuid::uuid4();
        $book   = array(
            'book_id' => $bookId,
            'title'   => $title,
            'author'  => $author,
            'isbn'    => $isbn,
        );
        $this->books->insert($book);
        return new $this->entityClass($book);
    }

    public function fetch($id)
    {
        $results = $this->table->select(array('book_id' => $id));
        if (! $results->count()) {
            throw new DomainException(sprintf(
                'Could not find book with ID "%s"',
                $id
            ), 404);
        }

        return $results->current();
    }

    public function fetchAll()
    {
        $paginator = new DbTableGatewayPaginator($this->table, null, array('author', 'title'));
        return new $this->collectionClass($paginator);
    }

    public function update($bookId, $data)
    {
        $where = array('book_id' => $bookId);
        $this->tasks->update($data, $where);
        $result = $this->tasks->select($where);
        if (! $result->count()) {
            throw new DomainException('Error retrieving updated book', 500);
        }
        return $result->current();
    }

    public function delete($bookId)
    {
        $this->tasks->delete(array('book_id' => $bookId));
        return true;
    }

    public function fetchBorrowed($userId)
    {
        $sql       = $this->table->getSql();
        $table     = $this->table->getTable();
        $joinTable = 'user_book';

        $select = $sql->select();
        $select->join($joinTable, "$table.book_id = $joinTable.book_id", array());
        $select->where(array("$joinTable.user_id" => $userId));
        $select->order(array('author', 'title'));

        return new $this->collectionClass(new DbSelectPaginator(
            $select,
            $sql,
            $this->table->getResultSetPrototype()
        ));
    }
}
