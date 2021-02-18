<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace Oauth2;

use think\Service;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Oauth2\Repository\ClientRepository;
use Oauth2\Repository\ScopeRepository;
use Oauth2\Repository\AccessTokenRepository;
use Oauth2\Repository\AuthCodeRepository;
use Oauth2\Repository\RefreshTokenRepository;
use Oauth2\Repository\UserEntity;
use think\facade\Db;
use think\Psr7\Response;
use think\Psr7\ServerRequest;
use think\Route;

class Oauth2Service extends Service
{
    public function register()
    {
        $this->app->bind('oauth', function () {
            $privateKey = root_path() . '/private.key';
            $encryptionKey = 'FB1Dp9FGEZInVA6E2iaD5K4i3HB6eT2G6FEtJFj9Gqg=';

            $clientRepository = new ClientRepository(Db::class);
            $accessTokenRepository = new AccessTokenRepository(Db::class);
            $scopeRepository = new ScopeRepository(Db::class);
            $authCodeRepository = new AuthCodeRepository(Db::class);
            $refreshTokenRepository = new RefreshTokenRepository(Db::class);

            // Setup the authorization server
            $server = new AuthorizationServer(
                $clientRepository,
                $accessTokenRepository,
                $scopeRepository,
                $privateKey,
                $encryptionKey
            );

            $grant = new \League\OAuth2\Server\Grant\AuthCodeGrant(
                $authCodeRepository,
                $refreshTokenRepository,
                new \DateInterval('PT10M') // authorization codes will expire after 10 minutes
            );

            $grant->setRefreshTokenTTL(new \DateInterval('P1M')); // refresh tokens will expire after 1 month

            // Enable the authentication code grant on the server
            $server->enableGrantType(
                $grant,
                new \DateInterval('PT1H') // access tokens will expire after 1 hour
            );

            return $server;
        });
    }

    public function boot()
    {
        $this->registerRoutes(function (Route $route) {
            // 发起授权
            $route->get('oauth/authorize', function (ServerRequest $request, Response $response) {
                try {

                    $authRequest = $this->app->oauth->validateAuthorizationRequest($request);

                    // The auth request object can be serialized and saved into a user's session.
                    // You will probably want to redirect the user at this point to a login endpoint.

                    // Once the user has logged in set the user on the AuthorizationRequest
                    $authRequest->setUser(new UserEntity()); // an instance of UserEntityInterface

                    // At this point you should redirect the user to an authorization page.
                    // This form will ask the user to approve the client and the scopes requested.

                    // Once the user has approved or denied the client update the status
                    // (true = approved, false = denied)
                    $authRequest->setAuthorizationApproved(true);

                    // Return the HTTP redirect response
                    return $this->app->oauth->completeAuthorizationRequest($authRequest, $response)->send();
                } catch (OAuthServerException $exception) {

                    // All instances of OAuthServerException can be formatted into a HTTP response
                    return $exception->generateHttpResponse($response)->send();
                }
            });
        });
    }
}
