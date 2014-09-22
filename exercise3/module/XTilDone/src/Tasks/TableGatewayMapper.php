<?php

namespace XTilDone\Tasks;

use DomainException;
use Rhumsaa\Uuid\Uuid;
use XTilDone\Lists\MapperInterface as ListMapperInterface;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbSelect as DbSelectPaginator;

class TableGatewayMapper implements MapperInterface
{
    protected $collectionClass;
    protected $entityClass;
    protected $lists;
    protected $tasks;
    protected $userListLinkTable;

    public function __construct(
        TableGatewayInterface $tasks,
        ListMapperInterface $lists,
        $userListLinkTable,
        $entityClass = 'ArrayObject',
        $collectionClass = 'Zend\Paginator\Paginator'
    )
    {
        $this->tasks = $tasks;
        $this->lists = $lists;
        $this->userListLinkTable = $userListLinkTable;
        $this->entityClass = $entityClass;
        $this->collectionClass = $collectionClass;
    }

    public function create($userId, $listId, $name)
    {
        $taskId = (string) Uuid::uuid4();
        $task   = array(
            'task_id'   => $taskId,
            'list_id'   => $listId,
            'name'      => $name,
            'completed' => 0,
        );
        $this->tasks->insert($task);
        return new $this->entityClass($task);
    }

    public function delete($userId, $listId, $taskId)
    {
        $this->tasks->delete(array('task_id' => $taskId));
        return true;
    }

    public function fetchAll($userId, $listId)
    {
        $table  = $this->tasks->getTable();
        $sql    = $this->tasks->getSql();
        $select = $sql->select();

        $select->columns(array('task_id', 'name', 'completed'));
        $select->quantifier('DISTINCT');
        $select->join(array('u' => 'user_list'), $table . '.list_id = u.list_id', array());
        $select->where(function ($where) use ($table, $listId, $userId) {
            $where->equalTo($table . '.list_id', $listId);
        });

        return new $this->collectionClass(new DbSelectPaginator(
            $select,
            $sql,
            $this->tasks->getResultSetPrototype()
        ));
    }

    public function update($userId, $listId, $taskId, $data)
    {
        $where = array('task_id' => $taskId);
        $this->tasks->update($data, $where);
        $result = $this->tasks->select($where);
        if (! $result->count()) {
            throw new DomainException('Error retrieving updated task', 500);
        }
        return $result->current();
    }
}
