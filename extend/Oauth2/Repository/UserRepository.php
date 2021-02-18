<?php

namespace Oauth2\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        $grantPattern = "%$grantType%";
        $row = $this->db::table('user')->where('username', $username)->whereLike('allowed_grant_types', $grantPattern)->field('id, password')->find();
        return $row && password_verify($password, $row["password"]) !== false ? new UserEntity($row["id"]) : null;
    }
}
