<?php

namespace Oauth2\Repository;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Creates a new AuthCode
     *
     * @return AuthCodeEntityInterface
     */
    public function getNewAuthCode()
    {
        return new AuthCodeEntity();
    }

    /**
     * Persists a new auth code to permanent storage.
     *
     * @param AuthCodeEntityInterface $authCodeEntity
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        $scopes = $authCodeEntity->getScopes();
        $allScopes = [];
        foreach ($scopes as $scope) {
            $allScopes[] = $scope->getIdentifier();
        }
        $scopes = implode(" ", $allScopes);

        $this->db::table('oauth_auth_codes')->insert([
            'auth_code' => $authCodeEntity->getIdentifier(),
            'client_id' => $authCodeEntity->getClient()->getIdentifier(),
            'user_id' => $authCodeEntity->getUserIdentifier(),
            'expires' => $authCodeEntity->getExpiryDateTime()->getTimestamp(),
            'scope' => $scopes,
        ]);
    }

    /**
     * Revoke an auth code.
     *
     * @param string $codeId
     */
    public function revokeAuthCode($codeId)
    {
        $this->db::table("oauth_auth_codes")->where('auth_code', $codeId)->update(['revoked' => true]);
    }

    /**
     * Check if the auth code has been revoked.
     *
     * @param string $codeId
     *
     * @return bool Return true if this code has been revoked
     */
    public function isAuthCodeRevoked($codeId)
    {
        $row = $this->db::table("oauth_auth_codes")->where('auth_code', $codeId)->find();
        return $row ? $row["revoked"] : true;
    }
}
