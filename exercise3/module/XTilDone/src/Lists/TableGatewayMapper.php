<?php

namespace XTilDone\Lists;

use DomainException;
use Rhumsaa\Uuid\Uuid;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway as DbTableGatewayPaginator;

class TableGatewayMapper implements MapperInterface
{
    protected $collectionClass;

    protected $entityClass;

    protected $table;

    public function __construct(
        TableGatewayInterface $table,
        $entityClass = 'ArrayObject',
        $collectionClass = 'Zend\Paginator\Paginator'
    ) {
        $this->table = $table;
        $this->entityClass = $entityClass;
        $this->collectionClass = $collectionClass;
    }

    public function create($title)
    {
        $listId = (string) Uuid::uuid4();
        $list   = array(
            'list_id' => $listId,
            'title'   => $title,
            'created' => time(),
        );
        $this->table->insert($list);

        return new $this->entityClass($list);
    }

    public function delete($listId)
    {
        $this->table->delete(array('list_id' => $listId));

        return true;
    }

    public function fetch($listId)
    {
        $results = $this->table->select(array('list_id' => $listId));
        if (! $results->count()) {
            throw new DomainException(sprintf(
                'Could not find list with ID "%s"',
                $id
            ), 404);
        }

        return $results->current();
    }

    public function fetchAll()
    {
        $paginator = new DbTableGatewayPaginator($this->table, null, 'created DESC');
        return new $this->collectionClass($paginator);
    }

    public function update($listId, $title)
    {
        // Update the list!
        $this->table->update(array(
            'title' => $title,
        ), array(
            'list_id' => $listId,
        ));

        return new $this->entityClass(array(
            'list_id' => $listId,
            'title'   => $title,
        ));
    }
}
