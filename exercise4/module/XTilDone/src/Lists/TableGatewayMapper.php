<?php

namespace XTilDone\Lists;

use DomainException;
use Rhumsaa\Uuid\Uuid;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbSelect as DbSelectPaginator;

class TableGatewayMapper implements MapperInterface
{
    protected $collectionClass;

    protected $entityClass;

    protected $table;

    protected $userLists;

    public function __construct(
        TableGatewayInterface $table,
        TableGatewayInterface $userLists,
        $entityClass = 'ArrayObject',
        $collectionClass = 'Zend\Paginator\Paginator'
    ) {
        $this->table = $table;
        $this->userLists = $userLists;
        $this->entityClass = $entityClass;
        $this->collectionClass = $collectionClass;
    }

    public function create($userId, $title)
    {
        $listId = (string) Uuid::uuid4();
        $list   = array(
            'list_id' => $listId,
            'title'   => $title,
        );
        $this->table->insert($list);

        $this->userLists->insert(array(
            'user_id'   => $userId,
            'list_id'   => $listId,
            'is_owner'  => 1,
            'can_read'  => 1,
            'can_write' => 1,
        ));

        return new $this->entityClass($list);
    }

    public function delete($userId, $listId)
    {
        $this->table->delete(array('list_id' => $listId));
        $this->userLists->delete(array('list_id' => $listId));

        return true;
    }

    public function fetch($userId, $listId)
    {
        $sql       = $this->table->getSql();
        $table     = $this->table->getTable();
        $userTable = $this->userLists->getTable();

        $select = $sql->select();
        $select->columns(array('list_id', 'title'));
        $select->join(array('u' => $userTable), $table . '.list_id = u.list_id');
        $select->where(function ($where) use ($table, $listId, $userId) {
            $where->equalTo($table . '.list_id', $listId)
                ->AND->equalTo('u.user_id', $userId)
                ->AND->NEST
                    ->equalTo('u.is_owner', 1)
                    ->OR
                    ->equalTo('u.can_read', 1)
                    ->OR
                    ->equalTo('u.can_write', 1)
                ->UNNEST;
        });

        $results = $this->table->selectWith($select);
        if (! $results->count()) {
            throw new DomainException(sprintf(
                'Could not find list with ID "%s" owned by current user',
                $id
            ), 404);
        }

        return $results->current();
    }

    public function fetchAll($userId)
    {
        $sql       = $this->table->getSql();
        $table     = $this->table->getTable();
        $userTable = $this->userLists->getTable();

        $select = $sql->select();
        $select->columns(array('list_id', 'title'));
        $select->join(array('u' => $userTable), $table . '.list_id = u.list_id');
        $select->where(function ($where) use ($userId) {
            $where->equalTo('u.user_id', $userId)
                ->AND->NEST
                    ->equalTo('u.is_owner', 1)
                    ->OR
                    ->equalTo('u.can_read', 1)
                    ->OR
                    ->equalTo('u.can_write', 1)
                ->UNNEST;
        });

        return new $this->collectionClass(new DbSelectPaginator(
            $select,
            $sql,
            $this->table->getResultSetPrototype()
        ));
    }

    public function update($userId, $listId, $title)
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

    public function isOwner($userId, $listId)
    {
        $sql       = $this->table->getSql();
        $table     = $this->table->getTable();
        $userTable = $this->userLists->getTable();

        $select = $sql->select();
        $select->columns(array('list_id', 'title'));
        $select->join(array('u' => $userTable), $table . '.list_id = u.list_id');
        $select->where(function ($where) use ($table, $listId, $userId) {
            $where->equalTo($table . '.list_id', $listId)
                ->AND->equalTo('u.user_id', $userId)
                ->AND->equalTo('u.is_owner', 1);
        });

        $results = $this->table->selectWith($select);
        return ($results->count() ? true : false);
    }

    public function canReadList($userId, $listId)
    {
        $sql       = $this->table->getSql();
        $table     = $this->table->getTable();
        $userTable = $this->userLists->getTable();

        $select = $sql->select();
        $select->columns(array('list_id', 'title'));
        $select->join(array('u' => $userTable), $table . '.list_id = u.list_id');
        $select->where(function ($where) use ($table, $listId, $userId) {
            $where->equalTo($table . '.list_id', $listId)
                ->AND->equalTo('u.user_id', $userId)
                ->AND->NEST
                    ->equalTo('u.is_owner', 1)
                    ->OR
                    ->equalTo('u.can_write', 1)
                    ->OR
                    ->equalTo('u.can_read', 1)
                ->UNNEST;
        });

        $results = $this->table->selectWith($select);
        return ($results->count() ? true : false);
    }

    public function canModifyList($userId, $listId)
    {
        $sql       = $this->table->getSql();
        $table     = $this->table->getTable();
        $userTable = $this->userLists->getTable();

        $select = $sql->select();
        $select->columns(array('list_id', 'title'));
        $select->join(array('u' => $userTable), $table . '.list_id = u.list_id');
        $select->where(function ($where) use ($table, $listId, $userId) {
            $where->equalTo($table . '.list_id', $listId)
                ->AND->equalTo('u.user_id', $userId)
                ->AND->NEST
                    ->equalTo('u.is_owner', 1)
                    ->OR
                    ->equalTo('u.can_write', 1)
                ->UNNEST;
        });

        $results = $this->table->selectWith($select);
        return ($results->count() ? true : false);
    }
}
