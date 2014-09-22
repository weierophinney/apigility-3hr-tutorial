<?php
namespace XTilDone;

use Rhumsaa\Uuid\Uuid;

class ListAuthorization
{
    const IS_READ  = 1;
    const IS_WRITE = 2;
    const IS_ADMIN = 4;

    protected $lists;

    public function __construct(Lists\MapperInterface $lists)
    {
        $this->lists = $lists;
    }

    /**
     * Authorize an action on the User API
     *
     * First parameter is for symmetry with the Lists API authorization check;
     * all we really need to do is validate that we have an authenticated user,
     * and that the user matches the user identifier requested.
     * 
     * @param  int $requestedPermission 
     * @param  string $userId 
     * @param  string $authenticatedUser 
     * @return bool
     */
    public function authorizeUserAction($requestedPermission, $userId, $authenticatedUser)
    {
        if (empty($userId)) {
            // requesting a list of users; valid if user is authenticated
            return Uuid::isValid($authenticatedUser);
        }

        if (! Uuid::isValid($userId) || ! Uuid::isValid($authenticatedUser)) {
            // Missing or invalid user or authenticated user identifier;
            // might as well indicate unauthorized
            return false;
        }

        if ($userId !== $authenticatedUser) {
            // Authenticated user does not match user requested
            return false;
        }

        return true;
    }

    /**
     * Authorize an action on the Lists API
     * 
     * @param  int $requestedPermission 
     * @param  string $listId 
     * @param  string $authenticatedUser 
     * @return null|bool
     */
    public function authorizeListAction($requestedPermission, $listId, $authenticatedUser)
    {
        if (! Uuid::isValid($listId) || ! Uuid::isValid($authenticatedUser)) {
            // Missing oriInvalid list identifier, or missing or unauthenticated user;
            // might as well indicate unauthorized
            return false;
        }

        if ($requestedPermission === self::IS_READ) {
            // Does the user have READ access?
            return $this->lists->canReadList($authenticatedUser, $listId);
        }

        if ($requestedPermission === self::IS_WRITE) {
            return $this->lists->canModifyList($authenticatedUser, $listId);
        }

        if ($requestedPermission === self::IS_ADMIN) {
            return $this->lists->isOwner($authenticatedUser, $listId);
        }

        // Unknown permission requested; fallback to default system
        return null;
    }
}
