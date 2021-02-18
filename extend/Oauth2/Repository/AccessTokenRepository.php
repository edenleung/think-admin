<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace Oauth2\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Create a new access token.
     *
     * @param ClientEntityInterface  $clientEntity
     * @param ScopeEntityInterface[] $scopes
     * @param mixed                  $userIdentifier
     *
     * @return AccessTokenEntityInterface
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $accessToken = new AccessTokenEntity();
        $accessToken->setClient($clientEntity);

        foreach ($scopes as $scope) {
            $accessToken->addScope(new ScopeEntity($scope));
        }

        $accessToken->setUserIdentifier($userIdentifier);

        return $accessToken;
    }

    /**
     * Persists a new access token to permanent storage.
     *
     * @param AccessTokenEntityInterface $accessTokenEntity
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $scopes = $accessTokenEntity->getScopes();
        $allScopes = [];
        foreach ($scopes as $scope) {
            $allScopes[] = $scope->getIdentifier();
        }
        $scopes = implode(' ', $allScopes);

        $this->db::table('oauth_access_tokens')->insert([
            'access_token' => $accessTokenEntity->getIdentifier(),
            'client_id'    => $accessTokenEntity->getClient()->getIdentifier(),
            'userid'       => $accessTokenEntity->getUserIdentifier(),
            'expires'      => $accessTokenEntity->getExpiryDateTime()->getTimestamp(),
            'scope'        => $scopes,
        ]);
    }

    /**
     * Revoke an access token.
     *
     * @param string $tokenId
     */
    public function revokeAccessToken($tokenId)
    {
        $this->db::table('oauth_access_tokens')->where('access_token', $tokenId)->update(['revoked' =>  true]);
    }

    /**
     * Check if the access token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isAccessTokenRevoked($tokenId)
    {
        $row = $this->db::table('oauth_access_tokens')->where('access_token', $tokenId)->field('revoked')->find();

        return $row ? $row['revoked'] : true;
    }
}
