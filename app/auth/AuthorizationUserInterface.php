<?php

namespace app\auth;

interface AuthorizationUserInterface
{
    public function username();
    public function password();
    public function hasUser(string $username);
    public function getUser(string $username);
    public function getPassword();
    public function createAccount(array $data);
    public function makeToken();
    public function verifyPassword(string $password);
}
