<?php

namespace Oauth2\Repository;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;

class AuthCodeEntity implements AuthCodeEntityInterface
{
    use TokenEntityTrait, EntityTrait, AuthCodeTrait;
}
