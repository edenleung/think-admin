<?php

namespace Oauth2\Repository;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Get a client.
     *
     * @param string $clientIdentifier The client's identifier
     *
     * @return ClientEntityInterface|null
     */
    public function getClientEntity($clientIdentifier)
    {
        $client = new ClientEntity();
        $row = $this->db::table('oauth_clients')->where('client_id', $clientIdentifier)->field('name, redirect_uri')->find();
        if ($row) {
            $client->setIdentifier($clientIdentifier);
            $client->setName($row["name"]);
            $client->setRedirectUri($row["redirect_uri"]);
            $client->setConfidential();
            return $client;
        }
    }

    /**
     * Validate a client's secret.
     *
     * @param string      $clientIdentifier The client's identifier
     * @param null|string $clientSecret     The client's secret (if sent)
     * @param null|string $grantType        The type of grant the client is using (if sent)
     *
     * @return bool
     */
    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        $grantPattern = "%$grantType%";
        $row = $this->db::table('oauth_clients')->where('client_id', $clientIdentifier)->whereLike('grant_types', $grantPattern)->field('client_secret')->find();
        return $row && password_verify($clientSecret, $row["client_secret"]) !== false;
    }
}
