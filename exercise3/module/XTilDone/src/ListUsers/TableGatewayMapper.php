<?php

namespace XTilDone\ListUsers;

use DomainException;
use XTilDone\Lists\MapperInterface as ListsMapperInterface;
use XTilDone\Users\MapperInterface as UsersMapperInterface;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbSelect as DbSelectPaginator;

class TableGatewayMapper implements MapperInterface
{
    protected $collectionClass;
    protected $entityClass;
    protected $lists;
    protected $userLists;
    protected $users;

    public function __construct(
        TableGatewayInterface $userLists,
        ListsMapperInterface $lists,
        UsersMapperInterface $users,
        $entityClass = 'ArrayObject',
        $collectionClass = 'Zend\Paginator\Paginator'
    ) {
        $this->userLists = $userLists;
        $this->lists = $lists;
        $this->users = $users;
        $this->entityClass = $entityClass;
        $this->collectionClass = $collectionClass;
    }

    public function create($ownerId, $listId, array $data)
    {
        $permissions = array(
            'can_write' => $data['can_write'],
            'can_read'  => $data['can_read'],
        );
        $userId = false;

        if (isset($data['user_id']) && $this->users->exists($data['user_id'])) {
            $userId = $data['user_id'];
        }

        if (! $userId && isset($data['username'])) {
            $userId = $this->users->byUsername($data['username']);
        }

        if (! $userId) {
            throw new DomainException('Invalid username and/or user identifier', 400);
        }

        $data = array_merge(
            $permissions,
            array(
                'user_id' => $userId,
                'list_id' => $listId,
            )
        );

        $this->userLists->insert($data);

        return new $this->entityClass($data);
    }
    
    public function delete($ownerId, $listId, $userId)
    {
        $this->userLists->delete(array(
            'user_id' => $userId,
            'list_id' => $listId,
        ));

        return true;
    }

    public function fetch($consumerId, $listId, $userId)
    {
        $result = $this->userLists->select(array(
            'user_id' => $userId,
            'list_id' => $listId,
        ));

        if (! $result->count()) {
            throw new DomainException('Could not find user associated with list', 404);
        }

        return $result->current();
    }

    public function fetchAll($consumerId, $listId)
    {
        $sql = $this->userLists->getSql();
        $select = $sql->select();
        $select->where(array('list_id' => $listId));
        return new $this->collectionClass(new DbSelectPaginator(
            $select,
            $sql,
            $this->userLists->getResultSetPrototype()
        ));
    }

    public function update($ownerId, $listId, $userId, array $permissions)
    {
        $where = array(
            'user_id' => $userId,
            'list_id' => $listId,
        );

        $this->userLists->update($permissions, $where);

        $result = $this->userLists->select($where);

        if (! $result->count()) {
            throw new DomainException('Error fetching updated permissions.', 500);
        }

        return $result->current();
    }
}
